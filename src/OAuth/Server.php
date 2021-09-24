<?php

declare(strict_types=1);

/*
 * Immobilienscout24 bundle for Contao Open Source CMS
 *
 * @copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
 * @author     Moritz Vondano
 * @license    MIT
 */

namespace Derhaeuptling\ContaoImmoscout24\OAuth;

use League\OAuth1\Client\Credentials\TemporaryCredentials;
use League\OAuth1\Client\Credentials\TokenCredentials;
use League\OAuth1\Client\Server\Server as BaseServer;

class Server extends BaseServer
{
    /** @var string */
    private $domain = 'immobilienscout24.de';

    /** @var string|null */
    private $verifier;

    public function __construct(string $key, string $secret, string $callbackUri = null)
    {
        parent::__construct([
            'identifier' => $key,
            'secret' => $secret,
            'callback_uri' => $callbackUri,
        ]);
    }

    public function urlTemporaryCredentials(): string
    {
        return "https://rest.$this->domain/restapi/security/oauth/request_token";
    }

    public function urlAuthorization(): string
    {
        return "https://rest.$this->domain/restapi/security/oauth/confirm_access";
    }

    public function urlTokenCredentials(): string
    {
        return "https://rest.$this->domain/restapi/security/oauth/access_token";
    }

    public function urlUserDetails(): void
    {
        throw new \RuntimeException('not implemented');
    }

    public function userDetails($data, TokenCredentials $tokenCredentials): void
    {
        throw new \RuntimeException('not implemented');
    }

    public function userUid($data, TokenCredentials $tokenCredentials): void
    {
        throw new \RuntimeException('not implemented');
    }

    public function userEmail($data, TokenCredentials $tokenCredentials): void
    {
        throw new \RuntimeException('not implemented');
    }

    public function userScreenName($data, TokenCredentials $tokenCredentials): void
    {
        throw new \RuntimeException('not implemented');
    }

    public function getTokenCredentials(TemporaryCredentials $temporaryCredentials, $temporaryIdentifier, $verifier): TokenCredentials
    {
        // Make verifier available during processing
        $this->verifier = $verifier;

        $credentials = parent::getTokenCredentials($temporaryCredentials, $temporaryIdentifier, $verifier);

        $this->verifier = null;

        return $credentials;
    }

    /**
     * Immoscout24 relies on the 'oauth_verifier' also being part of the
     * 'Authorization' header, so we need to adjust the protocol headers.
     */
    protected function additionalProtocolParameters(): array
    {
        return null === $this->verifier ? [] : [
            'oauth_verifier' => $this->verifier,
        ];
    }
}
