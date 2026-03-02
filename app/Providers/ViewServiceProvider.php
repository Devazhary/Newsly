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
        $categories = Category::select('id', 'slug', 'name')->get();

        if (!Cache::has('latest_posts')) {
            $latest_posts = Post::select('id', 'title', 'slug')->latest()->take(5)->get();
            Cache::remember('latest_posts', 3600, function () use ($latest_posts) {
                return $latest_posts;
            });
        }

        if (!Cache::has('popular_posts')) {
            $popular_posts = Post::withCount('comments')
                ->orderBy('comments_count', 'desc')
                ->limit(5)
                ->get();

            Cache::remember('popular_posts', 3600, function() use($popular_posts){
                return $popular_posts;
            });
        }

        $latest_posts = Cache::get('latest_posts');
        $popular_posts = Cache::get('popular_posts');

        view()->share([
            'RelatedSites' => $RelatedSites,
            'categories' => $categories,
            'latest_posts' => $latest_posts,
            'popular_posts' => $popular_posts,
        ]);
    }
}
