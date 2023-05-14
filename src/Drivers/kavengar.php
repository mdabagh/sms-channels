<?php

namespace Mdabagh\Smschannels\Drivers;

use Mdabagh\Smschannels\SmsChannelsInterface;
use Illuminate\Support\Facades\Http;

/**
 * کلاس Kavengar برای ارسال پیامک با استفاده از سرویس کاوه نگار
 */
class Kavengar implements SmsChannelsInterface
{
    /**
     * ارسال پیامک ساده با استفاده از سرویس کاوه نگار
     *
     * @param string $phone شماره تلفن دریافت کننده پیامک
     * @param string $message متن پیامک
     * @param string $sender شماره فرستنده پیامک (اختیاری)
     * @return mixed آرایه حاوی اطلاعات پیامک ارسال شده، یا false در صورت بروز خطا
     */
    public function sendSms($phone, $message, $sender = null)
    {
        $url = "https://api.kavenegar.com/v1/" . config('sms.kavenegar.api_key') . "/sms/send.json";
        $params = [
            'receptor' => $phone,
            'message' => $message,
            'sender' => $sender
        ];
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'charset' => 'utf-8'
        ])->get($url, $params);

        $body = $response->json();
        if ($body['return']['status'] == 200) {
            $result = [
                'status' => $body->{"IsSuccess"},
                'body' => $body['entries'][0]
            ];
            return $result;
        } else {
            return false;
        }
    }

    /**
     * ارسال کد تایید با استفاده از سرویس کاوه نگار
     *
     * @param string $phone شماره تلفن دریافت کننده کد تایید
     * @return mixed آرایه حاوی اطلاعات پیامک ارسال شده، یا false در صورت بروز خطا
     */
    public function sendVerifyCode($phone)
    {
        $url = "https://api.kavenegar.com/v1/" . config('sms.kavenegar.api_key') . "/verify/lookup.json";
        $params = [
            'receptor' => $phone,
            'token' => config('sms.kavenegar.token'),
            'template' => config('sms.kavenegar.template'),
            'type' => 'sms'
        ];
        if (config('sms.kavenegar.token2')) {
            $params['token2'] = config('sms.kavenegar.token2');
        }
        if (config('sms.kavenegar.token3')) {
            $params['token3'] = config('sms.kavenegar.token3');
        }
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'charset' => 'utf-8'
        ])->get($url, $params);

        $body = $response->json();
        if ($body['return']['status'] == 200) {
            $result = [
                'status' => $body->{"IsSuccess"},
                'body' => $body['entries'][0]
            ];
            return $result;
        } else {
            return false;
        }
    }

    /**
     * بررسی صحت کد تایید ارسال شده با استفاده از سرویس کاوه نگار
     *
     * @param string $phone شماره تلفن دریافت کننده کد تایید
     * @param string $key کد تایید ارسال شده برای شماره تلفن مورد نظر
     * @return mixed نتیجه بررسی کد تایید، یعنی true در صورت معتبر بودن کد و false در صورت نامعتبر بودن کد
     */
    public function checkVerifyCode($phone, $key)
    {
        // این متد در کاوه نگار تعریف نشده
        return null;
    }
}