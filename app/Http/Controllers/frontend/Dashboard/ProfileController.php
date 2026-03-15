<?php

namespace App\Http\Controllers\frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Utils\ImageManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index()
    {
        $posts = auth()->guard('web')->user()->posts()->active()->latest()->with('images')->get();
        return view('frontend.dashboard.profile', compact('posts'));
    }

    public function postStore(ProfileRequest $request)
    {

        try {

            DB::beginTransaction();

            $request->validated();
            $request->commentable == "on" ? $request->merge(['commentable' => 1]) : $request->merge(['commentable' => 0]);
            $post = auth()->guard('web')->user()->posts()->create($request->except(['_token', 'images']));

            ImageManger::uploadImages($request, $post);

            DB::commit();
            Cache::forget('read_more_posts');
            Cache::forget('latest_posts');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'An error occurred while creating the post.');
            return redirect()->back();
        }

        Session::flash('success', 'Post created successfully.');
        return redirect()->back();
    }

    public function postEdit($slug)
    {
        return $slug;
    }

    public function postDelete(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        if (!$post) {
            abort(404);
        }

        ImageManger::deleteImages($post);

        $post->delete();

        Session::flash('success', 'Post Deleted Successfully!');
        return redirect()->back();
    }

    public function getComments($id)
    {
        $comments = Comment::with('user')
            ->where('post_id', $id)
            ->where('user_id', auth()->guard('web')->user()->id)
            ->latest()
            ->get();

        if(!$comments)
        {
            return response()->json([
                'data' => null,
                'msg' => 'Something Went Wrong',
            ]);
        }

        return response()->json([
            'data' => $comments,
            'msg' => 'Get Data Successfully',
        ]);
    }
}
