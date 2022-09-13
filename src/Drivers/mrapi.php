<?php

namespace App\Strategy\SmsChannels\Drivers;

use App\Models\User;
use App\Strategy\SmsChannels\SmsChannelsInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class Mrapi implements SmsChannelsInterface
{
    public function sendVerifyCode($phone)
    {
        $response = Http::withHeaders([
            'Authentication' => env('AUTHENTICATION_MRAPI'),
            'Content-Type' => 'application/json'
        ])->post('http://api.mrapi.ir/V2/sms/send', [
            "PhoneNumber" => $phone ,
            "PatternID" => env('PATTERNID_MRAPI'),
            "Token" =>  env('TOKEN_MRAPI'),
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
