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
        $this->apiToken = $_ENV['AVANAK_API_TOKEN'];
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
    public function sendOtp(
        string $password,
        int    $length,
        string $number,
        int    $optionalCode = 0,
        int    $serverId = 0
    ): array
    {
        $response = $this->httpClient->request('GET', $this->apiUrl . '/SendOTP', [
            'query' => [
                'Token' => $this->apiToken,
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
        string $password,
        string $text,
        string $title,
        string $speaker = 'male',
        string $callFromMobile = ''
    ): array
    {
        $response = $this->httpClient->request('POST', $this->apiUrl . '/GenerateTTS', [
            'form_params' => [
                'Token' => $this->apiToken,
                'password' => $password,
                'Text' => $text,
                'Title' => $title,
                'Speaker' => $speaker,
                'CallFromMobile' => $callFromMobile
            ]
        ]);

        return json_decode($response->getBody(), true);
    }
    public function quickSendWithTTS(
        string $password,
        string $text,
        string $title,
        string $number,
        string $speaker,
        string $callFromMobile
    ): array
    {
        $response = $this->httpClient->request('POST', $this->apiUrl . '/QuickSendWithTTS', [
            'form_params' => [
                'Token' => $this->apiToken,
                'password' => $password,
                'Text' => $text,
                'Title' => $title,
                'Number' => $number,
                'Speaker' => $speaker,
                'CallFromMobile' => $callFromMobile
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    public function quickSend(
        string $password,
        int $messageId,
        string $number,
        bool $vote = false,
        int $serverId = 0,
        bool $recordVoice = false,
        int $recordVoiceDuration = 0
    ): array {
        $response = $this->httpClient->request('POST', $this->apiUrl . '/QuickSend', [
            'form_params' => [
                'Token' => $this->apiToken,
                'Password' => $password,
                'MessageID' => $messageId,
                'Number' => $number,
                'Vote' => $vote ? 'true' : 'false',
                'ServerID' => $serverId,
                'RecordVoice' => $recordVoice ? 'true' : 'false',
                'RecordVoiceDuration' => $recordVoiceDuration
            ]
        ]);

        return json_decode($response->getBody(), true);
    }
    public function getQuickSend(
        string $password,
        int $quickSendID
    ): array {
        $response = $this->httpClient->request('POST', $this->apiUrl . '/GetQuickSend', [
            'form_params' => [
                'Token' => $this->apiToken,
                'Password' => $password,
                'QuickSendID' => $quickSendID,
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * پیاده‌سازی متد دانلود پیام صوتی.
     *
     * @param  string  $messageId
     * @return mixed
     */
    // در کلاس AvanakClient
    public function downloadAudioMessage(string $messageId)
    {
        $response = $this->httpClient->request('GET', $this->apiUrl . '/DownloadMessage', [
            'query' => [
                'Token' => $this->apiToken,
                'MessageID' => $messageId,
            ]
        ]);

        return json_decode($response->getBody(), true);

    }

    public function getMessageDetails(string $messageId)
    {
        $response = $this->httpClient->request('GET', $this->apiUrl . '/GetMessage', [
            'query' => [
                'Token' => $this->apiToken,
                'MessageID' => $messageId,
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    // در کلاس AvanakClient
    public function deleteAudioMessage(string $messageId): array
    {
        $response = $this->httpClient->request('GET', $this->apiUrl . '/DeleteMessage', [
            'query' => [
                'Token' => $this->apiToken,
                'MessageID' => $messageId,
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    public function getMessages()
    {
        $response = $this->httpClient->request('GET', $this->apiUrl . '/GetMessages', [
            'query' => [
                'Token' => $this->apiToken,
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    public function getQuickSendStatistics(string $startDateTime, string $endDateTime): array
    {
        $response = $this->httpClient->request('GET', $this->apiUrl . '/GetQuickSendStatistics', [
            'query' => [
                'Token' => $this->apiToken,
                'StartDateTime' => $startDateTime,
                'EndDateTime' => $endDateTime,
            ]
        ]);

        return json_decode($response->getBody(), true);
    }












}
