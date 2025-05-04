<?php
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Mockery;
use Avanak\Services\OtpService;
use Avanak\Contracts\AvanakClientInterface;

class OtpServiceTest extends TestCase
{
    protected $avanakClientMock;
    protected $otpService;

    public function setUp(): void
    {
        parent::setUp();

        $this->avanakClientMock = Mockery::mock(AvanakClientInterface::class);
        $this->otpService = new OtpService($this->avanakClientMock);
    }

    public function testSendOtp(): void
    {
        $password = 'mySecretPassword';

        $expectedData = [
            'ErrorCode' => 0,
            'QuickSendID' => 1234,
            'GeneratedCode' => '5678'
        ];
        $this->avanakClientMock->shouldReceive('sendOtp')
            ->once()
            ->with($password, 6, '09927083001', 0, 0)
            ->andReturn($expectedData);

        $result = $this->otpService->sendOtp($password, 6, '09927083001', 0, 0);

        $this->assertEquals($expectedData, $result);
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
