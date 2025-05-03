<?php

namespace Avanak\Services;

use Avanak\Contracts\AvanakClientInterface;

class TtsService
{
    private AvanakClientInterface $avanakClient;

    public function __construct(AvanakClientInterface $avanakClient)
    {
        $this->avanakClient = $avanakClient;
    }

    public function generateTTS(string $token, string $password, string $text, string $title, string $speaker = 'male', string $callFromMobile = '')
    {
        return $this->avanakClient->generateTTS($token, $password, $text, $title, $speaker, $callFromMobile);
    }
}
