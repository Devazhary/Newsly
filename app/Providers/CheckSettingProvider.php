<?php

namespace App\Providers;

use App\Models\RelatedNewsSite;
use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use App\Models\Category;

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
        $getSetting = Setting::firstOr(function(){
            return Setting::create([
                'site_name' => 'Newsly',
                'favicon' => 'favicon.ico',
                'logo' => '/img/logo.png',
                'facebook' => 'https://www.facebook.com/',
                'instagram' => 'https://www.instagram.com/',
                'twitter' => 'https://x.com/',
                'youtube' => 'https://www.youtube.com/',
                'country' => 'Egypt',
                'city' => 'Tanta',
                'street' => 'elbahr st.',
                'email' => 'fakeEmail@gmail.com',
                'phone' => '01150304020',
            ]);
        });

        $RelatedSites = RelatedNewsSite::select('name', 'url')->get();
        
        $categories = Category::select('slug', 'name')->get();

        view()->share([
            'getSetting' => $getSetting,
            'RelatedSites' => $RelatedSites,
            'categories' => $categories,
        ]);
    }
}
