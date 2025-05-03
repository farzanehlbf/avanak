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
    public function sendOtp(string $phoneNumber, int $length, int $optionalCode = 0, int $serverId = 0): array;
}

