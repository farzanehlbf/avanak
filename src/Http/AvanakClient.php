<?php
namespace Avanak\Http;

use Avanak\Contracts\AvanakClientInterface;
use Avanak\Contracts\HttpClientInterface;

/**
 * Client implementation for communicating with the Avanak API.
 */
class AvanakClient implements AvanakClientInterface
{
    private HttpClientInterface $httpClient;
    private string $apiToken;
    private string $apiUrl;

    /**
     * @param HttpClientInterface $httpClient
     * @param string $apiUrl
     */
    public function __construct(HttpClientInterface $httpClient, string $apiUrl)
    {
        $this->httpClient = $httpClient;
        $this->apiToken =$_ENV['AVANAK_API_TOKEN'];
        $this->apiUrl = $apiUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function getAccountStatus(): array
    {
        $response = $this->httpClient->request('GET', $this->apiUrl . '/AccountStatus', [
            'query' => [
                'token' => $this->apiToken,
            ],
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * {@inheritdoc}
     */
    public function sendOtp(string $phoneNumber, int $length, int $optionalCode = 0, int $serverId = 0): array
    {
        $response = $this->httpClient->request('POST', $this->apiUrl . '/SendOTP', [
            'json' => [
                'token' => $this->apiToken,
                'phone_number' => $phoneNumber,
                'length' => $length,
                'optional_code' => $optionalCode,
                'server_id' => $serverId,
            ],
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}
