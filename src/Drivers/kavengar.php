<?php

namespace Mdabagh\Smschannels\Drivers;

use Mdabagh\Smschannels\SmsChannelsInterface;


class kavengar implements SmsChannelsInterface
{
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
            return $body['entries'][0];
        } else {
            return false;
        }
    }

    public function checkVerifyCode($phone, $key)
    {
        return ['kavengar'];
    }
}
