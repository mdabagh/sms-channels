<?php

namespace Mdabagh\Smschannels;

interface SmsChannelsInterface
{
    public function sendSms($phone , $message , $sender);
    public function sendVerifyCode($phone , $token = null);
    public function checkVerifyCode($phone , $key);
}
