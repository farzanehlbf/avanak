<?php
namespace Avanak\Support;

use Avanak\Contracts\HttpClientInterface;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

/**
 * Guzzle-based HTTP client implementation.
 */
class GuzzleHttpClient implements HttpClientInterface
{
    private Client $client;
    private string $token;

    /**
     * @param string $token
     * @param array $config
     */
    public function __construct(string $token, array $config = [])
    {
        $this->token = $token;
        $options['headers']['Authorization'] = 'Bearer ' . $this->token;

        $this->client = new Client($config);
    }

    /**
     * {@inheritdoc}
     */
    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
        if (!isset($options['headers']['Authorization'])) {
            $options['headers']['Authorization'] = 'Bearer ' . $this->token;
        }

        return $this->client->request($method, $url, $options);
    }
}
