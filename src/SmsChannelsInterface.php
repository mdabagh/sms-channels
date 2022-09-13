<?php

namespace Mdabagh\Smschannels;

interface SmsChannelsInterface
{
    public function sendVerifyCode($phone);
    public function checkVerifyCode($phone , $key);
}
