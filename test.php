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
$password = $_ENV['AVANAK_API_PASSWORD'];
$avanakClient = new AvanakClient($httpClient, 'https://portal.avanak.ir/Rest');

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$accountService = new AccountService($avanakClient);
$accountStatus = $accountService->getAccountStatus();
echo "Account Status: \n";
print_r($accountStatus);

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//متد وب سرویس ارسال رمز یکبار مصرف (SendOTP)
/*$length = 6;
$number = '09927083001';
$optionalCode = 0;
$serverId = 0;
$otpService = new OtpService($avanakClient);
$otpResponse = $otpService->sendOtp( $password, $length, $number, $optionalCode, $serverId);
echo "OTP Response: \n";
print_r($otpResponse);*/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//متد وب سرویس آپلود فایل صوتی (UploadMessageBase64)

/*$audioService = new AudioService($avanakClient);
$filePath = __DIR__ . '/src/Audio/audio_files/feri.m4a';
$audioFile = file_get_contents($filePath);
$base64Audio = base64_encode($audioFile);
$title = 'hello';
$persist = true;
$callFromMobile = '';

// تست متد uploadAudio
$audioResponse = $audioService->uploadAudio($base64Audio, $password, $title, $persist, $callFromMobile);
echo "Audio Upload Response: \n";
print_r($audioResponse);*/

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//// استفاده از سرویس TTS برای تولید صوت آواخوان


/*$text = "سرور شماره سه بررسی شود - هشدار قطع دسترسی";
$title = "فایل صوتی جدید";
$speaker = "female";
$callFromMobile = "";

$ttsService = new TtsService($avanakClient);
$ttsResponse = $ttsService->generateTTS($password, $text, $title, $speaker, $callFromMobile);

echo "TTS Response: \n";
print_r($ttsResponse);*/


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//متد ارسال سریع با آواخوان (QuickSendWithTTS)

/*$text = "سلام، این یک تماس سریع آواخوان است";
$title = "تماس فوری";
$number = "09927083001";
$speaker = "female";
$callFromMobile = "";

$ttsService = new TtsService($avanakClient);
$quickTTSResponse = $ttsService->quickSendWithTTS(
    $password,
    $text,
    $title,
    $number,
    $speaker,
    $callFromMobile
);
echo "Quick Send With TTS Response: \n";
print_r($quickTTSResponse);*/

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//متد ارسال سریع (QuickSend)
/*$title = "ارسال سریع با صوت ذخیره‌شده";
$number = "09927083001";
$callFromMobile = "";

$ttsService = new TtsService($avanakClient);
$quickSendResponse = $ttsService->quickSend(
    $password,
    36222488,              // MessageID (مثلاً ID صوتی که در سامانه آپلود شده)
    $number,     // Number
    false,             // Vote
    0,                 // ServerID
    false,             // RecordVoice
    0                  // RecordVoiceDuration
);

echo "Quick Send Response:\n";
print_r($quickSendResponse);*/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*try {
    // دریافت وضعیت ارسال سریع

    $ttsService = new TtsService($avanakClient);
    $quickSendStatus = $ttsService->getQuickSend($password, 81423034);

    echo "Quick Send Status:\n";
    print_r($quickSendStatus);
} catch (Exception $e) {
    echo "Error occurred:\n";
    echo $e->getMessage();
}*/

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//متد دانلود فایل صوتی (DownloadMessage)

$messageId = "36217661";

try {
    // دریافت داده‌های صوتی
    $audioData = $avanakClient->downloadAudioMessage($messageId);

    // مسیر ذخیره‌سازی فایل صوتی (مسیر کامل به همراه نام فایل)
    $filePath = __DIR__ . '/src/Audio/audio_files/audio_message_' . $messageId;

    // ذخیره‌سازی داده‌های صوتی در فایل
    file_put_contents($filePath, $audioData);

    print_r($audioData);
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//متد مشخصات فایل صوتی (GetMessage)

/*$messageId = "36221730";

try {
    // دریافت مشخصات پیام صوتی
    $messageDetails = $avanakClient->getMessageDetails($messageId);

    // نمایش مشخصات پیام
    print_r($messageDetails);
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}*/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/*$messageId = "36207304";

try {
    // حذف پیام صوتی
    $response = $avanakClient->deleteAudioMessage($messageId);

    // نمایش پاسخ
    print_r($response);
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}*/
/////////////////////////////////////////////////
//متد وب سرویس لیست فایل های صوتی (GetMessages)

/*try {
    // دریافت مشخصات پیام صوتی
    $messages = $avanakClient->getMessages();
    // نمایش مشخصات پیام
    print_r($messages);
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}*/
/////////////////////////////////////////////////
//متد وب سرویس گزارش آمار ارسالهای سریع (GetQuickSendStatistics)

// تاریخ و زمان شروع و پایان
/*$startDateTime = '2025-01-01 00:00:00'; // تاریخ شروع
$endDateTime = '2025-12-01 23:59:59'; // تاریخ پایان

try {
    // دریافت آمار ارسال‌های سریع
    $response = $avanakClient->getQuickSendStatistics($startDateTime, $endDateTime);

    // نمایش پاسخ
    print_r($response);
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}*/
