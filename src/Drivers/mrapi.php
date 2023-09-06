<?php

namespace Mdabagh\Smschannels\Drivers;

use Mdabagh\Smschannels\SmsChannelsInterface;
use Illuminate\Support\Facades\Http;

/**
 * کلاس Mrapi برای ارسال پیامک با استفاده از سرویس Mrapi
 */
class Mrapi implements SmsChannelsInterface
{
    /**
     * ارسال پیامک با الگوی تعیین شده در سرویس Mrapi
     *
     * @param string $phone شماره تلفن دریافت کننده پیامک
     * @param string $message متن پیامک (در این سرویس، متن پیامک باید در الگوی تعیین شده در سرویس قرار گیرد)
     * @param string $sender شماره فرستنده پیامک (اختیاری)
     * @return mixed آرایه حاوی اطلاعات پیامک ارسال شده، یا false در صورت بروز خطا
     */
    public function sendSms($phone , $message , $sender = null){
        // این متد در mrapi تعریف نشده
        return null;
    }
    
    /**
     * ارسال کد تایید با استفاده از سرویس Mrapi
     *
     * @param string $phone شماره تلفن دریافت کننده کد تایید
     * @return mixed آرایه حاوی اطلاعات پیامک ارسال شده، یا false در صورت بروز خطا
     */
    public function sendVerifyCode($phone , $token = null)
    {
        $response = Http::withHeaders([
            'Authentication' => config('sms.mrapi.authentication'),
            'Content-Type' => 'application/json'
        ])->post('http://api.mrapi.ir/V2/sms/send', [
            "PhoneNumber" => $phone ,
            "PatternID" => config('sms.mrapi.patternid'),
            "Token" =>  config('sms.mrapi.token'),
            "ProjectType" => 1
        ]);
        $body = json_decode($response->body());
        if ($body->{"IsSuccess"}) {
            $result = [
                'status' => $body->{"IsSuccess"},
                'body' => $body
            ];
            return $result;
        }else{
            return false;
        }
    }
    
    /**
     * بررسی صحت کد تایید ارسال شده با استفاده از سرویس Mrapi
     *
     * @param string $phone شماره تلفن دریافت کننده کد تایید
     * @param string $key کد تایید ارسال شده برای شماره تلفن مورد نظر
     * @return mixed نتیجه بررسی کد تایید، یعنی true در صورت معتبر بودن کد و false در صورت نامعتبر بودن کد
     */
    public function checkVerifyCode($phone, $key){
        $response = Http::withHeaders([
            'Authentication' => env('AUTHENTICATION_MRAPI'),
            'Content-Type' => 'application/json'
        ])->post('http://api.mrapi.ir/V2/sms/verify', [
            "PhoneNumber" => $phone ,
            "Code" => $key  ,
        ]);

        $body = json_decode($response->body());
        if ($body->{"IsSuccess"}) {
            return true;
        }else{
            return false;
        }
    }
}