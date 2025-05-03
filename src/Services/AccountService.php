<?php
namespace Avanak\Services;

use Avanak\Contracts\AvanakClientInterface;

/**
 * Service class for managing account-related operations.
 */
class AccountService
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
     * Get the account status via the client.
     *
     * @return array
     */
    public function getAccountStatus(): array
    {
        return $this->avanakClient->getAccountStatus();
    }
}
