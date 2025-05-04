<?php
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Mockery;
use Avanak\Http\AvanakClient;

class AvanakClientTest extends TestCase
{
    protected $avanakClient;

    public function setUp(): void
    {
        parent::setUp();
        $this->avanakClient = Mockery::mock(AvanakClient::class);
    }

    public function testDownloadAudioMessage(): void
    {
        $messageId = '36217661';
        $audioData = file_get_contents(__DIR__ . '/audio_files/hello.mp3');

        $this->avanakClient->shouldReceive('downloadAudioMessage')
            ->once()
            ->with($messageId)
            ->andReturn($audioData);

        $result = $this->avanakClient->downloadAudioMessage($messageId);

        $this->assertEquals($audioData, $result);
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
