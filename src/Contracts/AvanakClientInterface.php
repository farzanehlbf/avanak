<?php

namespace Avanak\Contracts;

interface AvanakClientInterface
{
    public function getAccountStatus(string $accountId): array;
    public function sendOtp(string $phoneNumber): array;
}
