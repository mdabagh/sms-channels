<?php
namespace Mdabagh\Smschannels\Drivers;

use Mdabagh\Smschannels\SmsChannelsInterface;

class Smsir implements SmsChannelsInterface
{
    public function sendSms($phone , $message , $sender){
        return ['Smsir'];
    }
    public function sendVerifyCode($phone)
    {
        return ['Smsir'];
    }
    public function checkVerifyCode($phone , $key)
    {
        return ['Smsir'];
    }
}
