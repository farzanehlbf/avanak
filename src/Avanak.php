<?php
namespace Avanak;

use Avanak\Contracts\AvanakClientInterface;
use Avanak\Services\AccountService;
use Avanak\Services\AudioService;
use Avanak\Services\OtpService;
use Avanak\Services\TtsService;

/**
 * Main entry class for accessing Avanak services.
 */
/**
 * Main entry class for accessing Avanak services.
 */
class Avanak
{
    protected AvanakClientInterface $client;

    /**
     * @param AvanakClientInterface $client
     */
    public function __construct(AvanakClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Access account-related services.
     *
     * @return AccountService
     */
    public function account(): AccountService
    {
        return new AccountService($this->client);
    }

    /**
     * Access OTP-related services.
     *
     * @return OtpService
     */
    public function otp(): OtpService
    {
        return new OtpService($this->client);
    }

    /**
     * Access audio-related services.
     *
     * @return AudioService
     */
    public function audio(): AudioService
    {
        return new AudioService($this->client);
    }

    public function tts(): TtsService
    {
        return new TtsService($this->client);
    }
    public function getQuickSend(string $token, string $password, int $quickSendID)
    {
        return $this->tts()->getQuickSend($token, $password, $quickSendID);
    }

    /**
     * Download audio message.
     *
     * @param string $messageId
     * @return mixed
     */
    public function downloadAudioMessage(string $messageId)
    {
        return $this->audio()->downloadAudioMessage($messageId);
    }



}
