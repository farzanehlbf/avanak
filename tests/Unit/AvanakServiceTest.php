<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Mockery;
use Avanak\Contracts\AvanakClientInterface;
use Avanak\Contracts\HttpClientInterface;
use Avanak\Http\AvanakClient;
use Avanak\Services\AccountService;
use Avanak\Services\OtpService;

class AvanakServiceTest extends TestCase
{
    protected $httpClientMock;
    protected $avanakClientMock;
    protected $accountService;
    protected $otpService;

    public function setUp(): void
    {
        parent::setUp();


        $this->httpClientMock = Mockery::mock(HttpClientInterface::class);
        $this->avanakClientMock = Mockery::mock(AvanakClientInterface::class);
        $this->accountService = new AccountService($this->avanakClientMock);
        $this->otpService = new OtpService($this->avanakClientMock);
    }

    public function testGetAccountStatus()
    {
        $this->avanakClientMock->shouldReceive('getAccountStatus')
            ->once()
            ->andReturn(['status' => 'active']);

        $response = $this->accountService->getAccountStatus();
        $this->assertEquals(['status' => 'active'], $response);
    }
    public function testSendOtp(): void
    {
        $expectedData = [
            'ErrorCode' => 0,
            'QuickSendID' => 1234,
            'GeneratedCode' => '5678'
        ];

        $this->avanakClientMock->shouldReceive('sendOtp')
            ->once()
            ->with('09927083001', 6, 0, 0) // ارسال همه پارامترها
            ->andReturn($expectedData);

        $result = $this->otpService->sendOtp('09927083001'); // فقط شماره تلفن ارسال می‌شود
        $this->assertEquals($expectedData, $result);
    }




    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
