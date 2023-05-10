<?php

namespace Mdabagh\Smschannels;

use Illuminate\Support\ServiceProvider;
use Mdabagh\Smschannels\Drivers\kavengar;
use Mdabagh\Smschannels\Facades\Sms;

class SmsChannelsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(SmsChannelsInterface::class, function() {
            return new kavengar;  //return new Smsir;
        });
    }
    
    public function boot(){
        $this->app->register(Sms::class);
    }
}
