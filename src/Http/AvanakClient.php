<?php

namespace Avanak\Http;

use Avanak\Contracts\AvanakClientInterface;
use Avanak\Contracts\HttpClientInterface;

class AvanakClient implements AvanakClientInterface
{
    private HttpClientInterface $httpClient;
    private string $apiUrl;

    public function __construct(HttpClientInterface $httpClient, string $apiUrl)
    {
        $this->httpClient = $httpClient;
        $this->apiUrl = $apiUrl;
    }

    public function getAccountStatus(string $accountId): array
    {
        $response = $this->httpClient->request('GET', $this->apiUrl . '/account/status', [
            'query' => ['account_id' => $accountId],
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function sendOtp(string $phoneNumber): array
    {
        $response = $this->httpClient->request('POST', $this->apiUrl . '/sendOtp', [
            'json' => ['phone_number' => $phoneNumber],
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}
