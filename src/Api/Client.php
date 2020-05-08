<?php

declare(strict_types=1);

/*
 * Immobilienscout24 bundle for Contao Open Source CMS
 *
 * @copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
 * @author     Moritz Vondano
 * @license    MIT
 */

namespace Derhaeuptling\ContaoImmoscout24\Api;

use Derhaeuptling\ContaoImmoscout24\Entity\Account;
use Derhaeuptling\ContaoImmoscout24\Entity\Attachment;
use Derhaeuptling\ContaoImmoscout24\Entity\RealEstate;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;

class Client
{
    /** @var GuzzleClient */
    private $client;

    /** @var Account */
    private $account;

    /**
     * Api constructor.
     */
    public function __construct(GuzzleClient $guzzleClient, Account $account)
    {
        $this->client = $guzzleClient;
        $this->account = $account;
    }

    /**
     * @throws PermissionDeniedException
     */
    public function getRealEstate(string $realEstateId): ?RealEstate
    {
        $data = $this->extractAndTagResponse(
            $this->performRequest(sprintf('user/me/realestate/%s', $realEstateId))
        );

        if (null === $data) {
            return null;
        }

        return RealEstate::createFromApiResponse($data, $this->account);
    }

    /**
     * @return \Generator|RealEstate[]
     */
    public function getAllRealEstate(int $pageNumberOffset = 0, int $pageSize = 100): \Generator
    {
        $pageSize = max(1, min(100, $pageSize)); // must be in the range [1 .. 100]
        $pageNumber = max(1, $pageNumberOffset + 1); // must be >= 1

        $requestUrl = sprintf('user/me/realestate?pageSize=%s&pagenumber=%s&archivedobjectsincluded=true', $pageSize, $pageNumber);
        $data = $this->performRequest($requestUrl);

        $list = $data['realestates.realEstates']['realEstateList']['realEstateElement'] ?? null;
        $next = $data['realestates.realEstates']['Paging']['next']['@xlink.href'] ?? null;

        if (null === $list) {
            return;
        }

        foreach ($list as $realEstateData) {
            // note: do not use RealEstate::createFromApiResponse($realEstate) here
            // as the current request does not include all data for some odd reason;
            // falling back to use single sub requests instead
            if (!\is_array($realEstateData) || !isset($realEstateData['@id'])) {
                continue;
            }

            $realEstate = $this->getRealEstate($realEstateData['@id']);
            if (null !== $realEstate) {
                yield $realEstate;
            }
        }

        if (null !== $next) {
            yield from $this->getAllRealEstate($pageNumberOffset + 1, $pageSize);
        }
    }

    /**
     * @return Attachment[]
     */
    public function getAttachments(RealEstate $realEstate): array
    {
        $response = $this->performRequest(sprintf('user/me/realestate/%s/attachment', $realEstate->realEstateId));

        if (null === ($attachmentData = $response['common.attachments'][0]['attachment'] ?? null) || !\is_array($attachmentData)) {
            return [];
        }

        if (isset($attachmentData['@id'])) {
            // handle single item (apparently the data structure changes then)
            $attachmentData = [$attachmentData];
        }

        return array_filter(
            array_map(static function ($data) use ($realEstate) {
                if (!\is_array($data)) {
                    return null;
                }

                return Attachment::createFromApiResponse($data, $realEstate);
            }, $attachmentData)
        );
    }

    private function extractAndTagResponse($data): ?array
    {
        if (!\is_array($data)) {
            return null;
        }

        $objectType = array_key_first($data);
        if (!\is_string($objectType)) {
            return null;
        }

        // tag data with object type
        $realEstateData = $data[$objectType];
        $realEstateData['_object_type'] = $objectType;

        return $realEstateData;
    }

    /**
     * @throws PermissionDeniedException
     */
    private function performRequest($endpoint): ?array
    {
        try {
            $response = $this->client->get($endpoint);

            if (200 !== $response->getStatusCode()) {
                return null;
            }

            $contents = $response->getBody()->getContents();
            $data = \GuzzleHttp\json_decode($contents, true);

            return \is_array($data) ? $data : null;
        } catch (ClientException $e) {
            // handle 401 (unauthorized)
            if ((null !== ($response = $e->getResponse())) && 401 === $response->getStatusCode()) {
                try {
                    // in case of an error the API ignores the accept header and always returns XML
                    /** @noinspection PhpComposerExtensionStubsInspection */
                    $contents = json_decode(json_encode(
                        (array) simplexml_load_string($response->getBody()->getContents())
                    ), true);
                    $message = $contents['message']['message'];
                } catch (\Exception $e2) {
                    $message = $e->getMessage();
                }

                throw new PermissionDeniedException($message);
            }

            // ignore
            return null;
        }
    }
}
