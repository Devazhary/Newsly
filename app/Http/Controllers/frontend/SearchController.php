<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //validation
        $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
        ]);

        //avoid writing code into search bar
        $keyword = strip_tags($request->search);

        //get results
        $posts = Post::where('title', 'LIKE', '%' . $keyword . '%')
            ->orWhere('description', 'LIKE', '%' . $keyword . '%')
            ->paginate(15);

        return view('frontend.search', compact('posts'));
    }
}
