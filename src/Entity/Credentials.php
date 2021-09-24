<?php

declare(strict_types=1);

/*
 * Immobilienscout24 bundle for Contao Open Source CMS
 *
 * @copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
 * @author     Moritz Vondano
 * @license    MIT
 */

namespace Derhaeuptling\ContaoImmoscout24\Entity;

use Doctrine\ORM\Mapping as ORM;
use League\OAuth1\Client\Credentials\TokenCredentials;

/**
 * @ORM\Embeddable()
 */
class Credentials
{
    /**
     * @ORM\Column(name="consumer_key", type="string", options={"default": ""})
     *
     * @var string
     */
    private $consumerKey;

    /**
     * @ORM\Column(name="consumer_secret", type="string", options={"default": ""})
     *
     * @var string
     */
    private $consumerSecret;

    /**
     * @ORM\Column(name="access_token", type="string", options={"default": ""})
     *
     * @var string
     */
    private $accessToken;

    /**
     * @ORM\Column(name="access_token_secret", type="string", options={"default": ""})
     *
     * @var string
     */
    private $accessTokenSecret;

    public function __construct(string $consumerKey, string $consumerSecret, string $accessToken, string $accessTokenSecret)
    {
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;
        $this->accessToken = $accessToken;
        $this->accessTokenSecret = $accessTokenSecret;
    }

    public function getConsumerKey(): string
    {
        return $this->consumerKey;
    }

    public function getConsumerSecret(): string
    {
        return $this->consumerSecret;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getAccessTokenSecret(): string
    {
        return $this->accessTokenSecret;
    }

    public function setAccessTokenCredentials(TokenCredentials $tokenCredentials): void
    {
        $this->accessToken = $tokenCredentials->getIdentifier();
        $this->accessTokenSecret = $tokenCredentials->getSecret();
    }
}
