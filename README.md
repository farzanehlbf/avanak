# Avanak API SDK (Laravel Compatible)

This package provides an interface to connect with the **Avanak API** and supports features like voice call sending, OTP delivery, text-to-speech (TTS) generation, managing voice messages, and reporting.

## 📦 Package Structure

```
Avanak/
├── Contracts/
│   ├── AvanakClientInterface.php      # Main interface for interacting with the Avanak API
│   └── HttpClientInterface.php        # Abstraction layer for the HTTP client (e.g., Guzzle)
│
├── Http/
│   └── AvanakClient.php               # Implementation of AvanakClientInterface
│
├── Services/
│   ├── AccountService.php             # Fetch account status
│   ├── AudioService.php               # Manage audio files (upload, delete, download, details)
│   ├── OtpService.php                 # Send OTP
│   └── TtsService.php                 # Send TTS call, generate TTS, quick send message
│
├── Support/
│   └── GuzzleHttpClient.php           # Guzzle-based implementation of HttpClientInterface
```

## 🧰 Installation

If installing locally:

```bash
composer require path/to/avanak
```

Or, add to your `composer.json`:

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

## ⚙️ Environment Setup

In your `.env` file, add the Avanak API token:

```env
AVANAK_API_TOKEN=your_avanak_token
```

## 🧱 Usage

### 1. Define the client:

```php
use Avanak\Support\GuzzleHttpClient;
use Avanak\Http\AvanakClient;

$httpClient = new GuzzleHttpClient(env('AVANAK_API_TOKEN'));
$client = new AvanakClient($httpClient, 'https://api.avanak.ir');
```

### 2. Use the services:

#### Get account status:

```php
use Avanak\Services\AccountService;

$service = new AccountService($client);
$status = $service->getAccountStatus();
```

#### Send OTP:

```php
use Avanak\Services\OtpService;

$service = new OtpService($client);
$response = $service->sendOtp('your_password', 5, '09123456789');
```

#### Generate TTS:

```php
use Avanak\Services\TtsService;

$service = new TtsService($client);
$response = $service->generateTTS('your_password', 'Sample text', 'Message Title');
```

#### Quick send with TTS:

```php
$response = $service->quickSendWithTTS('your_password', 'Sample text', 'Title', '09123456789');
```

#### Send voice call using existing message ID:

```php
$response = $service->quickSend('your_password', 1234, '09123456789');
```

#### Get quick send details:

```php
$response = $service->getQuickSend('your_password', 4567);
```

#### Upload audio file:

```php
use Avanak\Services\AudioService;

$audioService = new AudioService($client);
$base64Audio = base64_encode(file_get_contents('file.mp3'));
$response = $audioService->uploadAudio($base64Audio, 'your_password', 'Message Title', true);
```

#### Download audio message:

```php
$response = $audioService->downloadAudioMessage('message_id');
```

#### Get message details:

```php
$response = $audioService->getMessageDetails('message_id');
```

#### Delete audio message:

```php
$response = $audioService->deleteAudioMessage('message_id');
```

#### Get all messages:

```php
$response = $audioService->getMessages();
```

#### Get quick send statistics:

```php
$response = $audioService->getQuickSendStatistics('2024-01-01T00:00:00', '2024-12-31T23:59:59');
```

## 🧪 Testing

Automated tests have not been added yet. It is recommended to use Postman or curl for manual request validation.

## 🔒 Security

Ensure all sensitive data such as API tokens are stored in the `.env` file and **never committed** to version control.

## 🧑‍💻 Contributing

Contributions and pull requests to improve this package are welcome!

## 📜 License

This package is released under the [MIT License](LICENSE).
