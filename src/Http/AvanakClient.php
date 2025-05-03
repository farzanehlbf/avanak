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
    private $baseUrl;


    /**
     * @param HttpClientInterface $httpClient
     * @param string $apiUrl
     */
    public function __construct(HttpClientInterface $httpClient, string $apiUrl, string $baseUrl)
    {
        $this->httpClient = $httpClient;
        $this->apiToken = $_ENV['AVANAK_API_TOKEN'];
        $this->apiUrl = $apiUrl;
        $this->baseUrl = $baseUrl;
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
    public function sendOtp(
        string $token,
        string $password,
        int    $length,
        string $number,
        int    $optionalCode = 0,
        int    $serverId = 0
    ): array
    {
        $response = $this->httpClient->request('GET', $this->apiUrl . '/SendOTP', [
            'query' => [
                'Token' => $token,
                'password' => $password,
                'Length' => $length,
                'Number' => $number,
                'OptionalCode' => $optionalCode,
                'ServerID' => $serverId,
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    public function uploadAudio(string $base64Audio, string $password, string $title, bool $persist, string $callFromMobile = ''): array
    {
        $response = $this->httpClient->request('POST', $this->apiUrl . '/UploadMessageBase64', [
            'json' => [
                'token' => $this->apiToken,
                'password' => $password,
                'title' => $title,
                'base64' => $base64Audio,
                'persist' => $persist,
                'callFromMobile' => $callFromMobile,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function generateTTS(
        string $token,
        string $password,
        string $text,
        string $title,
        string $speaker = 'male',
        string $callFromMobile = ''
    ): array
    {
        $response = $this->httpClient->request('POST', $this->apiUrl . '/GenerateTTS', [
            'form_params' => [
                'Token' => $_ENV['AVANAK_API_TOKEN'],
                'password' => $password,
                'Text' => $text,
                'Title' => $title,
                'Speaker' => $speaker,
                'CallFromMobile' => $callFromMobile
            ]
        ]);

        return json_decode($response->getBody(), true);
    }


}
