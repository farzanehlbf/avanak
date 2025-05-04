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

    public function generateTTS(string $password, string $text, string $title, string $speaker = 'male', string $callFromMobile = '')
    {
        return $this->avanakClient->generateTTS($password, $text, $title, $speaker, $callFromMobile);
    }
    public function quickSendWithTTS(
        string $password,
        string $text,
        string $title,
        string $number,
        string $speaker = 'male',
        string $callFromMobile = ''
    )
    {
        return $this->avanakClient->quickSendWithTTS($password, $text, $title, $number, $speaker, $callFromMobile);
    }

    public function quickSend(
        string $password,
        int $messageId,
        string $number,
        bool $vote = false,
        int $serverId = 0,
        bool $recordVoice = false,
        int $recordVoiceDuration = 0
    ) {
        return $this->avanakClient->quickSend(
            $password,
            $messageId,
            $number,
            $vote,
            $serverId,
            $recordVoice,
            $recordVoiceDuration
        );
    }
    public function getQuickSend(
        string $password,
        int $quickSendID
    ) {
        return $this->avanakClient->getQuickSend($password, $quickSendID);
    }





}
