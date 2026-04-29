<?php

namespace App\Http\Controllers\frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Utils\ImageManger;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        $posts = auth()->guard('web')->user()->posts()->active()->latest()->with('images')->get();
        return view('frontend.dashboard.profile', compact('posts'));
    }

    public function postStore(ProfileRequest $request)
    {
        $request->validated();

        try {

            DB::beginTransaction();

            $request->commentable == "on" ? $request->merge(['commentable' => 1]) : $request->merge(['commentable' => 0]);
            $post = auth()->guard('web')->user()->posts()->create($request->except(['_token', 'images']));

            ImageManger::uploadImages($request, $post);

            DB::commit();
            Cache::forget('read_more_posts');
            Cache::forget('latest_posts');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while creating the post.');
        }

        return redirect()->back()->with('success', 'Post created successfully.');
    }

    public function postDelete(Request $request, $slug)
    {
        $post = Post::with('images')->where('slug', $slug)->first();

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

        if (!$comments) {
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

    public function showForm($slug)
    {
        $post = Post::with('images')->whereSlug($slug)->first();
        if (!$post) {
            abort(404);
        }
        return view('frontend.dashboard.edit-post', compact('post'));
    }

    public function postEdit(ProfileRequest $request, $slug)
    {

        $post = Post::with('images')->where('slug', $slug)->first();
        if (!$post) {
            abort(404);
        }
        $request->validated();

        try {
            DB::beginTransaction();
            $request->commentable == "on" ? $request->merge(['commentable' => 1]) : $request->merge(['commentable' => 0]);
            $post->update($request->except(['images', '_method', '_token']));

            if ($request->hasFile('images')) {
                ImageManger::deleteImages($post);

                foreach ($request->images as $image) {
                    $fileName = ImageManger::generateImageName($image);
                    $path = ImageManger::storeImageLocal($image, 'posts', $fileName);
                    $post->images()->create([
                        'path' => $path,
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while updating the post.');
        }

        return redirect()->back()->with('success', 'Post Updated Successfully!');
    }

    public function deleteImage(Request $request)
    {
        $image = Image::findOrFail($request->key);
        if (!$image) {
            return response()->json([
                'status' => 201,
                'msg' => 'Image Not Found',
            ]);
        }
        ImageManger::deleteImageInLocalAndDb($image);
        return response()->json([
            'status' => 200,
            'msg' => 'Image Deleted Successfully',
        ]);
    }
}
