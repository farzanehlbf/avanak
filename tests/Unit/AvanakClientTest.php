<?php

namespace Tests;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;
use Mockery;
use Avanak\Contracts\HttpClientInterface;
use Avanak\Http\AvanakClient;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class AvanakClientTest extends TestCase
{
    protected $httpClientMock;
    protected $avanakClient;

    public function setUp(): void
    {
        parent::setUp();
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
        $this->httpClientMock = Mockery::mock(HttpClientInterface::class);
        $this->avanakClient = new AvanakClient($this->httpClientMock, 'https://portal.avanak.ir/Rest');

    }

    public function testGetAccountStatus(): void
    {
        $expectedData = ['status' => 'active'];
        $streamMock = Mockery::mock(StreamInterface::class);
        $streamMock->shouldReceive('getContents')->andReturn(json_encode($expectedData));

        $responseMock = Mockery::mock(ResponseInterface::class);
        $responseMock->shouldReceive('getBody')->andReturn($streamMock);

        $httpClientMock = Mockery::mock(HttpClientInterface::class);
        $httpClientMock->shouldReceive('request')->andReturn($responseMock);

        $avanakClient = new AvanakClient($httpClientMock, 'https://portal.avanak.ir/Rest');

        $result = $avanakClient->getAccountStatus();

        $this->assertEquals($expectedData, $result);
    }

    public function testSendOtp(): void
    {
        $expectedData = [
            'ErrorCode' => 0,
            'QuickSendID' => 1234,
            'GeneratedCode' => '5678'
        ];

        $responseMock = Mockery::mock(ResponseInterface::class);
        $streamMock = Mockery::mock(StreamInterface::class);
        $streamMock->shouldReceive('getContents')->andReturn(json_encode($expectedData));
        $responseMock->shouldReceive('getBody')->andReturn($streamMock);

        $this->httpClientMock->shouldReceive('request')
            ->once()
            ->with('POST', 'https://portal.avanak.ir/Rest/SendOTP', Mockery::any())
            ->andReturn($responseMock);

        $result = $this->avanakClient->sendOtp('09927083001', 6, 0, 0);
        $this->assertEquals($expectedData, $result);
    }



    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
