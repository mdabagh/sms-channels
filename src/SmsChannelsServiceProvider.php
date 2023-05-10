<?php

namespace Mdabagh\Smschannels;

use Illuminate\Support\ServiceProvider;
use Mdabagh\Smschannels\Drivers\kavengar;
use Mdabagh\Smschannels\Drivers\kavengar;
use Mdabagh\Smschannels\Drivers\kavengar;

use Mdabagh\Smschannels\Facades\Sms;

class SmsChannelsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('SmsChannelsInterface', function () {
            $driverActive = config('sms.driver_active');
            return new $driverActive;  //return new Smsir;
        });
        $this->app->bind('Sms', function () {
            return new Sms;
        });
        $this->mergeConfigFrom(__DIR__.'/../config/sms.php', 'sms');

    }
    
    public function boot(){

    }
}
