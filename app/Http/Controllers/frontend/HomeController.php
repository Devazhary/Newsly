<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('images')->latest()->paginate(9);
        $posts_most_read = Post::with('images')->orderBy('num_of_views', 'desc')->take(3)->get();
        $oldest_post = Post::with('images')->oldest()->take(3)->get();
        $popular_posts = Post::withCount('comments')->orderBy('comments_count', 'desc')->take(3)->get();
        $categories = Category::with([
            'posts'=>function($query){
            $query->latest()->take(4);
        }])
        ->get();
        return view('frontend.index', compact('posts', 'posts_most_read', 'oldest_post', 'popular_posts', 'categories'));
    }
}
