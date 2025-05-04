<?php
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Mockery;
use Avanak\Services\TtsService;
use Avanak\Contracts\AvanakClientInterface;

class TtsServiceTest extends TestCase
{
    protected $avanakClientMock;
    protected $ttsService;

    public function setUp(): void
    {
        parent::setUp();
        $this->avanakClientMock = Mockery::mock(AvanakClientInterface::class);
        $this->ttsService = new TtsService($this->avanakClientMock);
    }

    public function testGenerateTTS(): void
    {
        $password = 'mySecretPassword';
        $text = 'سلام. تست';
        $title = 'فایل صوتی جدید';
        $speaker = 'female';
        $callFromMobile = '';

        $expectedData = [
            'AudioUrl' => 'https://some-url.com/audio.mp3',
            'MessageID' => 123456
        ];

        $this->avanakClientMock->shouldReceive('generateTTS')
            ->once()
            ->with($password, $text, $title, $speaker, $callFromMobile)
            ->andReturn($expectedData);

        $result = $this->ttsService->generateTTS($password, $text, $title, $speaker, $callFromMobile);
        $this->assertEquals($expectedData, $result);
    }
    public function testQuickSendWithTTS(): void
    {
        $password = 'mySecretPassword';
        $text = 'سلام، این یک تماس سریع آواخوان است';
        $title = 'تماس فوری';
        $number = '09927083001';
        $speaker = 'female';
        $callFromMobile = '';

        $expectedData = [
            'QuickSendID' => 1234,
            'Status' => 'Success'
        ];

        $this->avanakClientMock->shouldReceive('quickSendWithTTS')
            ->once()
            ->with($password, $text, $title, $number, $speaker, $callFromMobile)
            ->andReturn($expectedData);

        $result = $this->ttsService->quickSendWithTTS(
            $password, $text, $title, $number, $speaker, $callFromMobile
        );

        $this->assertEquals($expectedData, $result);
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
