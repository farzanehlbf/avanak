<?php

// بارگذاری خودکار کلاس‌ها
require __DIR__ . '/vendor/autoload.php';

// استفاده از کلاس‌های پکیج
use Avanak\Support\GuzzleHttpClient;
use Avanak\Http\AvanakClient;
use Avanak\Services\AccountService;
use Avanak\Services\OtpService;

use Dotenv\Dotenv;

// بارگذاری متغیرهای محیطی از فایل .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();



// ایجاد نمونه از GuzzleHttpClient و ارسال توکن به constructor
$httpClient = new GuzzleHttpClient($_ENV['AVANAK_API_TOKEN']);

// ایجاد نمونه از AvanakClient
$avanakClient = new AvanakClient($httpClient, 'https://portal.avanak.ir/Rest');


// ایجاد نمونه از AccountService
$accountService = new AccountService($avanakClient);

// تست متد getAccountStatus
$accountStatus = $accountService->getAccountStatus();
echo "Account Status: \n";
print_r($accountStatus); // نمایش نتیجه

// ایجاد نمونه از OtpService
$otpService = new OtpService($avanakClient);

// تست متد sendOtp
$otpResponse = $otpService->sendOtp('09927083001', 6, 0, 0);
echo "OTP Response: \n";
print_r($otpResponse); // نمایش نتیجه
