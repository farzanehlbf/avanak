<?php

namespace Avanak\Services;

use Avanak\Contracts\AvanakClientInterface;

/**
 * Service class for managing audio file operations.
 */
class AudioService
{
    private AvanakClientInterface $avanakClient;

    /**
     * @param AvanakClientInterface $avanakClient
     */
    public function __construct(AvanakClientInterface $avanakClient)
    {
        $this->avanakClient = $avanakClient;
    }

    /**
     * Upload an audio file.
     *
     * @param string $base64Audio
     * @return array
     */
    public function uploadAudio(string $base64Audio, string $password, string $title, bool $persist, string $callFromMobile = ''): array
    {
        return $this->avanakClient->uploadAudio($base64Audio, $password, $title, $persist, $callFromMobile);
    }

    /**
     * دانلود فایل صوتی بر اساس شناسه پیام.
     *
     * @param  string  $messageId
     * @return mixed
     */
    public function downloadAudioMessage(string $messageId)
    {
        return $this->avanakClient->downloadAudioMessage($messageId);
    }

    public function getMessageDetails(string $messageId)
    {
        return $this->avanakClient->getMessageDetails($messageId);
    }

    public function deleteAudioMessage(string $messageId): array
    {
        return $this->avanakClient->deleteAudioMessage($messageId);
    }

    public function getMessages()
    {
        return $this->avanakClient->getMessages();
    }

    public function getQuickSendStatistics(string $startDateTime, string $endDateTime): array
    {
        return $this->avanakClient->getQuickSendStatistics($startDateTime, $endDateTime);
    }
}
