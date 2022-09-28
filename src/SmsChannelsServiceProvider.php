<?php

namespace Mdabagh\Smschannels;

use Illuminate\Support\ServiceProvider;

class SmsChannelsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(SmsChannelsInterface::class, function() {
            return new kavengar;  //return new Smsir;
        });

    }
    
    public function boot(){
        
    }
}
