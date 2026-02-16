<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('images')->paginate(9);
        return view('frontend.index', compact('posts'));
    }
}
