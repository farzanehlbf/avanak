<?php
namespace Avanak;

use Avanak\Contracts\AvanakClientInterface;
use Avanak\Services\AccountService;
use Avanak\Services\OtpService;

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
}
