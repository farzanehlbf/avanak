<?php

namespace Avanak\Services;

use Avanak\Contracts\AvanakClientInterface;

class AccountService
{
    private AvanakClientInterface $avanakClient;

    public function __construct(AvanakClientInterface $avanakClient)
    {
        $this->avanakClient = $avanakClient;
    }

    public function getAccountStatus(string $accountId): array
    {
        return $this->avanakClient->getAccountStatus($accountId);
    }
}
