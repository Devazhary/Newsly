<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
    public function show($slug)
    {
        $mainPost = Post::with(['comments'=>function($query){$query->latest()->limit(3);}])->where('slug', $slug)->first();
        $category = $mainPost->category;
        $posts_belong_to_category = $category
            ->posts()
            ->select('id', 'title', 'slug')
            ->take(6)
            ->get();

        return view('frontend.show', compact('mainPost', 'posts_belong_to_category', 'category'));
    }

    public function getAllComments($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $comments = $post->comments()->with('user')->get();
        return response()->json($comments);
    }

    public function storeComments(Request $request)
    {
        //validation
        $request->validate([
            'post_id'=> ['required', 'exists:posts,id'],
            'user_id'=> ['required', 'exists:users,id'],
            'comment' => ['required', 'string'],
        ]);

        //store into db
        $comment = Comment::create([
            'comment' => $request->comment,
            'post_id' => $request->post_id,
            'user_id' => $request->user_id,
            'ip_address' => $request->ip(),
        ]);

        $comment->load('user');

        //check if store
        if(!$comment)
        {
            return response()->json([
                'data' => 'Operation Failed',
                'status' => 403,
            ]);
        }

        return response()->json([
            'msg' => 'Comment Stored Successfully',
            'comment' => $comment,
            'status' => 201,
        ]);
    }
}
