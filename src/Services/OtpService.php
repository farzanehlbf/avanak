<?php

namespace Avanak\Services;

use Avanak\Contracts\AvanakClientInterface;

class OtpService
{
    private AvanakClientInterface $avanakClient;

    public function __construct(AvanakClientInterface $avanakClient)
    {
        $this->avanakClient = $avanakClient;
    }

    public function sendOtp(string $phoneNumber, int $length = 6, ?int $optionalCode = 0, ?int $serverId = 0): array
    {
        return $this->avanakClient->sendOtp($phoneNumber, $length, $optionalCode, $serverId);
    }

}
