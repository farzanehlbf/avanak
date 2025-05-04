# Avanak API SDK (Laravel Compatible)

این پکیج، یک واسط برای اتصال به API آوانک است و امکاناتی مانند ارسال تماس صوتی، OTP، تولید متن به گفتار (TTS)، مدیریت پیام‌های صوتی و گزارش‌گیری را فراهم می‌کند.

## 📦 ساختار پکیج

```bash
Avanak/
├── Contracts/
│   ├── AvanakClientInterface.php      # اینترفیس اصلی برای تعامل با API آوانک
│   └── HttpClientInterface.php        # اینترفیس برای abstraction از HTTP client (مانند Guzzle)
│
├── Http/
│   └── AvanakClient.php               # پیاده‌سازی اصلی AvanakClientInterface
│
├── Services/
│   ├── AccountService.php             # دریافت وضعیت حساب
│   ├── AudioService.php               # مدیریت فایل‌های صوتی (آپلود، حذف، دانلود، دریافت جزییات)
│   ├── OtpService.php                 # ارسال OTP
│   └── TtsService.php                 # ارسال تماس با TTS، تولید TTS، ارسال سریع پیام
│
├── Support/
│   └── GuzzleHttpClient.php           # پیاده‌سازی HttpClientInterface با استفاده از Guzzle
```

## 🧰 نصب

اگر این پکیج را به صورت محلی ساخته‌اید:

```bash
composer require path/to/avanak
```

یا در composer.json:

```json
"repositories": [
  {
    "type": "path",
    "url": "./packages/avanak"
  }
],
"require": {
  "your-vendor/avanak": "*"
}
```

## ⚙️ تنظیمات محیطی

در `.env` مقدار توکن API را اضافه کنید:

```env
AVANAK_API_TOKEN=your_avanak_token
```

## 🧱 نحوه استفاده

### 1. تعریف کلاینت:

```php
use Avanak\Support\GuzzleHttpClient;
use Avanak\Http\AvanakClient;

$httpClient = new GuzzleHttpClient(env('AVANAK_API_TOKEN'));
$client = new AvanakClient($httpClient, 'https://api.avanak.ir');
```

### 2. استفاده از سرویس‌ها:

#### دریافت وضعیت حساب:

```php
use Avanak\Services\AccountService;

$service = new AccountService($client);
$status = $service->getAccountStatus();
```

#### ارسال OTP:

```php
use Avanak\Services\OtpService;

$service = new OtpService($client);
$response = $service->sendOtp('your_password', 5, '09123456789');
```

#### تولید TTS:

```php
use Avanak\Services\TtsService;

$service = new TtsService($client);
$response = $service->generateTTS('your_password', 'متن تست', 'عنوان پیام');
```

#### ارسال سریع TTS:

```php
$response = $service->quickSendWithTTS('your_password', 'متن تست', 'عنوان', '09123456789');
```

#### ارسال تماس با ID پیام صوتی:

```php
$response = $service->quickSend('your_password', 1234, '09123456789');
```

#### دریافت جزئیات تماس سریع:

```php
$response = $service->getQuickSend('your_password', 4567);
```

#### آپلود فایل صوتی:

```php
use Avanak\Services\AudioService;

$audioService = new AudioService($client);
$base64Audio = base64_encode(file_get_contents('file.mp3'));
$response = $audioService->uploadAudio($base64Audio, 'your_password', 'عنوان پیام', true);
```

#### دانلود فایل صوتی:

```php
$response = $audioService->downloadAudioMessage('message_id');
```

#### دریافت جزئیات پیام صوتی:

```php
$response = $audioService->getMessageDetails('message_id');
```

#### حذف پیام صوتی:

```php
$response = $audioService->deleteAudioMessage('message_id');
```

#### دریافت لیست پیام‌ها:

```php
$response = $audioService->getMessages();
```

#### دریافت آمار ارسال‌ها:

```php
$response = $audioService->getQuickSendStatistics('2024-01-01T00:00:00', '2024-12-31T23:59:59');
```

## 🧪 تست‌ها

> هنوز تست‌های خودکار اضافه نشده‌اند. پیشنهاد می‌شود از Postman یا curl برای بررسی دستی درخواست‌ها استفاده کنید.

## 🔒 امنیت

اطمینان حاصل کنید که توکن‌ها و اطلاعات حساس در `.env` نگهداری شوند و هرگز در نسخه کنترل سورس آپلود نشوند.

## 🧑‍💻 مشارکت

پیشنهادها و Pull Requestها برای بهبود این پکیج خوش‌آمد هستند.

## 📜 مجوز

این پکیج تحت لایسنس MIT منتشر شده است.
