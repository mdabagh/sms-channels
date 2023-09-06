# SMS Channels Package

The SMS Channels package provides an easy way to send SMS messages using multiple channels such as Kavenegar, Sms.ir, and others. With this package, you can easily send your SMS messages through different channels.

## Installation

You can install the package via Composer using the following command:

```bash
composer require mdabagh/smschannels
```

## Configuration

In your `.env` file, you can define the active driver and the settings and keys for each driver. The `MSM_DRIVE_ACTIVE` variable specifies the default driver to use.

```
MSM_DRIVE_ACTIVE=mrapi

# mrapi driver
MRAPI_AUTHENTICATION=
MRAPI_TOKEN=
MRAPI_PATTERNID=

# KAVENEGAR driver
KAVENEGAR_API_KEY=
KAVENEGAR_TEMPLATE=

```

## Usage

To use the package in your controller, you can use the `Sms` facade. First, you need to add the following `use` statement to your controller:

```php
use Mdabagh\Smschannels\Facades\Sms;
```

After that, you can use the `sendVerifyCode()` and `checkVerifyCode()` methods provided by the `Sms` facade to send and verify SMS verification codes. For example:

```php
$phone = '09123456789';
$code = Sms::sendVerifyCode($phone);
// Save $code to verify the code later

// When verifying the code
$key = '1234'; // The code entered by the user
$result = Sms::checkVerifyCode($phone, $key);
if ($result->status) {
    $body = $result->body;
    // The verification code is correct
} else {
    // The verification code is incorrect
}
```

## License

The SMS Channels package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
