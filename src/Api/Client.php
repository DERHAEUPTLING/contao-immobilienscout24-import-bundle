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

    public function getRealEstate(string $realEstateId): ?RealEstate
    {
        $data = $this->performRequest(sprintf('user/me/realestate/%s', $realEstateId));
        if (null === $data) {
            return null;
        }

        $realEstate = array_shift($data);

        if (null === $realEstate) {
            return null;
        }

        return RealEstate::createFromApiResponse($realEstate, $this->account);
    }

    /**
     * @return \Generator|RealEstate[]
     */
    public function getAllRealEstate(int $pageNumberOffset = 0, int $pageSize = 100): \Generator
    {
        $pageSize = max(1, min(100, $pageSize)); // must be in the range [1 .. 100]
        $pageNumber = max(1, $pageNumberOffset + 1); // must be >= 1

        $requestUrl = sprintf('user/me/realestate?pageSize=%s&pagenumber=%s', $pageSize, $pageNumber);
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
            // ignore
            return null;

            // todo handle 404?
            // todo log 401
        }
    }
}
