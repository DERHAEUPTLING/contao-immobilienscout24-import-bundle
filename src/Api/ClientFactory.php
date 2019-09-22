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
use Derhaeuptling\ContaoImmoscout24\Entity\Credentials;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class ClientFactory
{
    public function create(Account $account, bool $debug = false): Client
    {
        $stack = HandlerStack::create();

        $stack->push($this->getOAuthMiddleware($account->getCredentials()));

        $options = [
            'base_uri' => 'https://rest.immobilienscout24.de/restapi/api/offer/v1.0/',
            'handler' => $stack,
            RequestOptions::AUTH => 'oauth',
            RequestOptions::HEADERS => ['Accept' => 'application/json'],
        ];

        if ($debug) {
            $options = array_merge($options, [
                RequestOptions::DEBUG => true,
                RequestOptions::HTTP_ERRORS => false,
            ]);
        }

        return new Client(new GuzzleClient($options), $account);
    }

    private function getOAuthMiddleware(Credentials $credentials): Oauth1
    {
        return new Oauth1([
            'consumer_key' => $credentials->getConsumerKey(),
            'consumer_secret' => $credentials->getConsumerSecret(),
            'token' => $credentials->getAccessToken(),
            'token_secret' => $credentials->getAccessTokenSecret(),
        ]);
    }
}
