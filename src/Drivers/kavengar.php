<?php

namespace Mdabagh\Smschannels\Drivers;

use Mdabagh\Smschannels\SmsChannelsInterface;


class kavengar implements SmsChannelsInterface
{
    public function sendVerifyCode($phone)
    {
        return ['kavengar'];
    }
    public function checkVerifyCode($phone , $key)
    {
        return ['kavengar'];
    }
}
