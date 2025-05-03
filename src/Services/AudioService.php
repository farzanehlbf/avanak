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
}
