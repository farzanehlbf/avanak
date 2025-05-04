<?php

namespace Avanak\Contracts;

/**
 * Interface for Avanak API client.
 */
interface AvanakClientInterface
{
    /**
     * Get the account status from the Avanak API.
     *
     * @return array
     */
    public function getAccountStatus(): array;

    /**
     * Send an OTP (one-time password) to a phone number.
     *
     * @param string $phoneNumber
     * @return array
     */
    public function sendOtp(string $password, int $length, string $number, int $optionalCode = 0, int $serverId = 0): array;

    /**
     * Upload an audio file as base64 string.
     *
     * @param string $base64Audio The base64-encoded audio file content.
     * @return array
     */
    public function uploadAudio(string $base64Audio, string $password, string $title, bool $persist, string $callFromMobile = ''): array;


    public function generateTTS(string $password, string $text, string $title, string $speaker = 'male', string $callFromMobile = '');

    /**
     * Send quick TTS call.
     *
     * @param string $token
     * @param string $password
     * @param string $text
     * @param string $title
     * @param string $number
     * @param string $speaker
     * @param string $callFromMobile
     * @return array
     */
    public function quickSendWithTTS(
        string $password,
        string $text,
        string $title,
        string $number,
        string $speaker,
        string $callFromMobile
    ): array;

    /**
     * Send quick call with sound ID.
     *
     * @param string $token
     * @param string $password
     * @param int $soundId
     * @param string $title
     * @param string $number
     * @param string $callFromMobile
     * @return array
     */
    public function quickSend(
        string $password,
        int    $messageId,
        string $number,
        bool   $vote,
        int    $serverId,
        bool   $recordVoice,
        int    $recordVoiceDuration
    ): array;

    public function getQuickSend(
        string $password,
        int    $quickSendID
    ): array;

    /**
     * دانلود فایل صوتی.
     *
     * @param string $messageId
     * @return mixed
     */
    public function downloadAudioMessage(string $messageId);

    public function getMessageDetails(string $messageId);

    public function deleteAudioMessage(string $messageId): array;

    public function getMessages();

    public function getQuickSendStatistics(string $startDateTime, string $endDateTime): array;


}

