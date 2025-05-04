<?php
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Mockery;
use Avanak\Services\AudioService;
use Avanak\Contracts\AvanakClientInterface;

class AudioServiceTest extends TestCase
{
    protected $avanakClientMock;
    protected $audioService;

    public function setUp(): void
    {
        parent::setUp();
        $this->avanakClientMock = Mockery::mock(AvanakClientInterface::class);
        $this->audioService = new AudioService($this->avanakClientMock);
    }

    public function testUploadAudio(): void
    {
        $password = 'mySecretPassword';
        $base64Audio = base64_encode(file_get_contents(__DIR__ . '/audio_files/hello.mp3'));
        $title = 'hello';
        $persist = true;
        $callFromMobile = '';

        $expectedData = [
            'FileUrl' => 'https://some-url.com/audio.mp3',
            'MessageID' => 123456
        ];

        $this->avanakClientMock->shouldReceive('uploadAudio')
            ->once()
            ->with($base64Audio, $password, $title, $persist, $callFromMobile)
            ->andReturn($expectedData);

        $result = $this->audioService->uploadAudio($base64Audio, $password, $title, $persist, $callFromMobile);
        $this->assertEquals($expectedData, $result);
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
