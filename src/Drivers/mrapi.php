<?php

namespace Mdabagh\Smschannels\Drivers;

use Mdabagh\Smschannels\SmsChannelsInterface;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class Mrapi implements SmsChannelsInterface
{
    public function sendVerifyCode($phone)
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
            return true;
        }else{
            return false;
        }
    }
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
