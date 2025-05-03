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
    public function sendOtp(string $token, string $password, int $length, string $number, int $optionalCode = 0, int $serverId = 0)
    {
        $response = $this->avanakClient->sendOtp($token, $password, $length, $number, $optionalCode, $serverId);
        return $response;
    }

}
