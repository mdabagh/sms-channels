<?php

namespace App\Strategy\SmsChannels\Drivers;
use App\Strategy\SmsChannels\SmsChannelsInterface;


class Smsir implements SmsChannelsInterface
{
    public function sendVerifyCode($phone)
    {
        return ['Smsir'];
    }
    public function checkVerifyCode($phone , $key)
    {
        return ['Smsir'];
    }
}
