# Developer Guide - Avanak SDK

## Overview

This SDK allows developers to interact with the Avanak API through an elegant and structured interface. The SDK provides services for:

- Account status retrieval
- OTP sending

## Directory Structure

- `src/Contracts`: Interfaces and abstractions.
- `src/Http`: Avanak API client implementation.
- `src/Services`: Business logic built on top of the API client.
- `examples/`: Sample usage scripts.

## Interfaces

All implementations adhere to contracts defined under `Avanak\Contracts`, allowing for high testability and extensibility.

## Authentication

A token is passed to the `GuzzleHttpClient`, and it will automatically be injected into every request.

## How to Extend

To add a new service:

1. Create a new service class in `src/Services/`.
2. Implement required methods using `AvanakClientInterface`.

## Sample Usage

```php
$httpClient = new GuzzleHttpClient('YOUR_TOKEN');
$avanakClient = new AvanakClient($httpClient, 'https://portal.avanak.ir/Rest');
$accountService = new AccountService($avanakClient);

$status = $accountService->getAccountStatus();
