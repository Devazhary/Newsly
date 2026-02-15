<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;

class CheckSettingProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Setting::firstOr(function(){
            return Setting::create([
                'site_name' => 'My Website',
                'favicon' => 'favicon.ico',
                'logo' => 'logo.png',
                'facebook' => 'https://www.facebook.com/yourpage',
                'instagram' => 'https://www.instagram.com/yourprofile',
                'twitter' => 'https://www.twitter.com/yourprofile',
                'youtube' => 'https://www.youtube.com/yourchannel',
                'country' => 'Your Country',
                'city' => 'Your City',
                'street' => 'Your Street',
                'email' => 'Your Email',
                'phone' => 'Your Phone',
            ]);
        });
    }
}
