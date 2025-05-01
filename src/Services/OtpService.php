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

    public function sendOtp(string $phoneNumber): array
    {
        return $this->avanakClient->sendOtp($phoneNumber);
    }
}
