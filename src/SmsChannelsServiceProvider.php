<?php

namespace Mdabagh\Smschannels;

use Illuminate\Support\ServiceProvider;
use Mdabagh\Smschannels\Drivers\kavengar;
use Mdabagh\Smschannels\Facades\Sms;

class SmsChannelsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('SmsChannelsInterface', function () {
            return new kavengar;  //return new Smsir;
        });
        $this->app->bind('Sms', function () {
            return new Sms;
        });
    }
    
    public function boot(){

    }
}
