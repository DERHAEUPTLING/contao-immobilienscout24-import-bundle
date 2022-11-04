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
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class Client
{
    /** @var HttpClientInterface */
    private readonly HttpClientInterface $client;

    /**
     * Api constructor.
     */
    public function __construct(private readonly Account $account, int $timeout = 5, int $maxHostConnections = 6)
    {
        $this->client = new OAuthHttpClient(
            $account->getCredentials(),
            [
                'base_uri' => 'https://rest.immobilienscout24.de/restapi/api/offer/v1.0/',
                'headers' => [
                    'Accept' => 'application/json'
                ],
            ],
            $timeout,
            $maxHostConnections
        );
    }

    /**
     * @return \Generator<RealEstate>
     *
     * @throws TimeoutException
     */
    public function getAllRealEstate(): \Generator
    {
        // Synchronously get all list data
        $list = [];

        $populateList = function(int $pageNumberOffset = 0, int $pageSize = 100) use (&$populateList, &$list): void {
            $pageSize = max(1, min(100, $pageSize)); // must be in the range [1 .. 100]
            $pageNumber = max(1, $pageNumberOffset + 1); // must be >= 1

            $response = $this->client->request(
                'GET',
                sprintf('user/me/realestate?pageSize=%s&pagenumber=%s&archivedobjectsincluded=true', $pageSize, $pageNumber)
            );

            if(
                200 !== $response->getStatusCode() ||
                null === ($data = $this->getData($response)) ||
                null === ($listChunk = $data['realestates.realEstates']['realEstateList']['realEstateElement'] ?? null)
            ) {
                return;
            }

            $list = [...$list, ...$listChunk];

            if(isset($data['realestates.realEstates']['Paging']['next']['@xlink.href'])) {
                $populateList($pageNumberOffset + 1, $pageSize);
            }
        };

        $populateList();

        // Compose asynchronously handled responses
        $responses = [];

        foreach ($list as $realEstateData) {
            if (!\is_array($realEstateData) || null === ($realEstateId = ($realEstateData['@id'] ?? null))) {
                continue;
            }

            // make a separate request to get the full data for this real estate object
            $responses[] = $this->client->request(
                'GET',
                sprintf('user/me/realestate/%s', $realEstateId),
                ['user_data' => ['realEstateId' => $realEstateId]]
            );
        }

        // Process responses
        yield from $this->processAsync(
            $responses,
            function(array $data): ?RealEstate {
                if (!\is_string($objectType = array_key_first($data))) {
                    return null;
                }

                $realEstateData = [
                    ...$data[$objectType],
                    '_object_type' => $objectType,
                ];

                return RealEstate::createFromApiResponse($realEstateData, $this->account);
            },
            static function(array $userData): void {
                throw new TimeoutException(sprintf('The API timed out while requesting real estate ID %s', $userData['realEstateId']));
            }
        );
    }

    /**
     * @param list<RealEstate> $realEstateObjects
     * @return \Generator<array{0:string, 1:int}>
     *
     * @throws TimeoutException
     */
    public function getAndSetAttachments(array $realEstateObjects): \Generator
    {
        // Compose asynchronously handled responses
        $responses = [];

        foreach ($realEstateObjects as $realEstate) {
            $responses[] = $this->client->request(
                'GET',
                sprintf('user/me/realestate/%s/attachment', $realEstate->getRealEstateId()),
                ['user_data' => ['realEstate' => $realEstate]]
            );
        }

        // Process responses
        yield from $this->processAsync(
            $responses,
            function(array $data, array $userData): ?array {
                if (!is_array(($attachmentData = $data['common.attachments'][0]['attachment'] ?? null))) {
                    return null;
                }

                if (isset($attachmentData['@id'])) {
                    // handle single item (apparently the data structure changes then)
                    $attachmentData = [$attachmentData];
                }

                /** @var RealEstate $realEstate */
                $realEstate = $userData['realEstate'];

                $attachments = array_filter(
                    array_map(
                        static fn($attachmentData) => Attachment::createFromApiResponse($attachmentData, $realEstate),
                        $attachmentData
                    )
                );

                $realEstate->setAttachments($attachments);

                return [$realEstate->getRealEstateId(), \count($attachments)];
            },
            static function(array $userData): void {
                /** @var RealEstate $realEstate */
                $realEstate = $userData['realEstate'];

                throw new TimeoutException(sprintf('The API timed out while requesting attachments for real estate ID %s', $realEstate->getRealEstateId()));
            }
        );
    }

    /**
     * @param list<ResponseInterface>     $responses
     * @param \Closure<array> $handleResponseData
     */
    private function processAsync(array $responses, \Closure $handleResponseData, \Closure $handleTimeout): \Generator {
        foreach ($this->client->stream($responses) as $response => $chunk) {
            if ($chunk->isTimeout()) {
                $response->cancel();
                $handleTimeout($response->getInfo()['user_data'] ?? []);

                continue;
            }

            if ($chunk->isFirst() && 200 !== $response->getStatusCode()) {
                $response->cancel();

                continue;
            }

            if (
                $chunk->isLast() &&
                null !== ($data = $this->getData($response)) &&
                null !== ($result = $handleResponseData($data, $response->getInfo()['user_data'] ?? []))
            ) {
                yield $result;
            }
        }
    }

    private function getData(ResponseInterface $response): ?array {
        try {
            return json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
        } catch (TransportException|\JsonException) {
            return null;
        }
    }
}
