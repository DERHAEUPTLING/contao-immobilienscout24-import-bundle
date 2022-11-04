<?php
declare(strict_types=1);

namespace Derhaeuptling\ContaoImmoscout24\Api;

use Derhaeuptling\ContaoImmoscout24\Entity\Credentials;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Symfony\Contracts\HttpClient\ResponseStreamInterface;

class OAuthHttpClient implements HttpClientInterface
{
    private readonly HttpClientInterface $inner;
    private readonly string $key;

    public function __construct(
        private readonly Credentials $credentials,
        private readonly array $defaultOptions,
        int $timeout,
        int $maxHostConnections
    )
    {
        $this->inner = HttpClient::create(['timeout' => $timeout], $maxHostConnections);

        $this->key = sprintf(
            "%s&%s",
            rawurlencode($this->credentials->getConsumerSecret()),
            rawurlencode($this->credentials->getAccessTokenSecret())
        );
    }

    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
        $allOptions = [...$this->defaultOptions, ...$options];
        $effectiveUrl = ltrim(rtrim($allOptions['base_uri'] ?? '', '/') . '/' . $url, '/');

        return $this->inner->request(
            $method,
            $url,
            $this->addOAuthAuthorizationHeader($method, $effectiveUrl, $allOptions)
        );
    }

    public function stream($responses, float $timeout = null): ResponseStreamInterface
    {
        return $this->inner->stream($responses, $timeout);
    }

    /**
     * Adds an OAuth authorization header with HMAC-SHA1 signing to the request
     * options ('three-legged OAuth1').
     */
    private function addOAuthAuthorizationHeader(string $method, string $url, array $options): array
    {
        $urlParts = parse_url($url);
        parse_str($urlParts['query'] ?? '', $queryParts);

        // Sign request
        $nonce = sha1(uniqid('', true) . $urlParts['host'] . $urlParts['path']);

        $oauthParams = [
            'oauth_consumer_key' => $this->credentials->getConsumerKey(),
            'oauth_nonce' => $nonce,
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_timestamp' => time(),
            'oauth_token' => $this->credentials->getAccessToken(),
            'oauth_version' => '1.0',
        ];

        $params = $oauthParams + $queryParts;
        uksort($params, 'strcmp');

        $baseString = sprintf(
            "%s&%s&%s",
            strtoupper($method),
            rawurlencode(strtok($url, '?')),
            rawurlencode(http_build_query($params, '', '&', PHP_QUERY_RFC3986))
        );

        $oauthParams['oauth_signature'] = base64_encode(hash_hmac('sha1', $baseString, $this->key, true));

        // Add Authorization header
        uksort($oauthParams, 'strcmp');

        foreach ($oauthParams as $key => $value) {
            $oauthParams[$key] = sprintf('%s="%s"', $key, rawurlencode((string)$value));
        }

        $options['headers']['Authorization'] = 'OAuth ' . implode(', ', $oauthParams);

        return $options;
    }
}
