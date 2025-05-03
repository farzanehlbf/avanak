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
    public function sendOtp(string $token, string $password, int $length, string $number, int $optionalCode = 0, int $serverId = 0): array;

    /**
     * Upload an audio file as base64 string.
     *
     * @param string $base64Audio The base64-encoded audio file content.
     * @return array
     */
    public function uploadAudio(string $base64Audio, string $password, string $title, bool $persist, string $callFromMobile = ''): array;


    public function generateTTS(string $token, string $password, string $text, string $title, string $speaker = 'male', string $callFromMobile = '');

}

