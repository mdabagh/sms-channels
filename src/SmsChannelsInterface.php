<?php

namespace Mdabagh\Smschannels;

interface SmsChannelsInterface
{
    public function sendSms($phone , $message , $sender);
    public function sendVerifyCode($phone);
    public function checkVerifyCode($phone , $key);
}
