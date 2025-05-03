<?php

require __DIR__ . '/vendor/autoload.php';
use Avanak\Services\AudioService;
use Avanak\Services\TtsService;
use Avanak\Support\GuzzleHttpClient;
use Avanak\Http\AvanakClient;
use Avanak\Services\AccountService;
use Avanak\Services\OtpService;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
$httpClient = new GuzzleHttpClient($_ENV['AVANAK_API_TOKEN']);
$password = 'feripowerful';
$avanakClient = new AvanakClient($httpClient, 'https://portal.avanak.ir/Rest', 'https://baseurl.com');

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$accountService = new AccountService($avanakClient);
$accountStatus = $accountService->getAccountStatus();
echo "Account Status: \n";
print_r($accountStatus);

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ایجاد نمونه از OtpService
//$length = 6;
//$number = '09927083001';
//$optionalCode = 0;
//$serverId = 0;
//$otpService = new OtpService($avanakClient);
//$otpResponse = $otpService->sendOtp($_ENV['AVANAK_API_TOKEN'], $password, $length, $number, $optionalCode, $serverId);
//echo "OTP Response: \n";
//print_r($otpResponse);
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//$audioService = new AudioService($avanakClient);
//$filePath = __DIR__ . '/src/Audio/audio_files/water.mp3';
//$audioFile = file_get_contents($filePath);
//$base64Audio = base64_encode($audioFile);
//$password = 'feripowerful';
//$title = 'water';
//$persist = true;
//$callFromMobile = '';
//
//// تست متد uploadAudio
//$audioResponse = $audioService->uploadAudio($base64Audio, $password, $title, $persist, $callFromMobile);
//echo "Audio Upload Response: \n";
//print_r($audioResponse);

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//// استفاده از سرویس TTS برای تولید صوت آواخوان


$text = "سلام . این یک پیام صوتی می‌باشد";
$title = "فایل صوتی جدید";
$speaker = "male"; // یا 'female'
$callFromMobile = "";

$ttsService = new TtsService($avanakClient);
$ttsResponse = $ttsService->generateTTS($_ENV['AVANAK_API_TOKEN'], $password, $text, $title, $speaker, $callFromMobile);

echo "TTS Response: \n";
print_r($ttsResponse);
