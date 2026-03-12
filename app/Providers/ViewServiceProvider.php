<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use App\Models\Post;
use App\Models\RelatedNewsSite;
use App\Models\Category;

class ViewServiceProvider extends ServiceProvider
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

        $RelatedSites = RelatedNewsSite::select('id', 'name', 'url')->get();
        $categories = Category::active()->select('id', 'slug', 'name')->get();

        view()->share([
            'RelatedSites' => $RelatedSites,
            'categories' => $categories,
        ]);
    }
}
