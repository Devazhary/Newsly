<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Image;
use App\Models\Post;
use App\Utils\ImageManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sort_by = request()->sort ?? 'id';
        $order_by = request()->order_by ?? 'desc';
        $limit_by = request()->limit_by ?? 5;

        $posts = Post::where('user_id', '!=', null)->when(request()->keyword, function ($query) {
            $query->where('title', 'LIKE', '%' . request()->keyword . '%');
        })
            ->when(!is_null(request()->status), function ($query) {
                $query->where('status', request()->status);
            })
            ->orderBy($sort_by, $order_by)
            ->paginate($limit_by);
        return view('admin.posts.index', compact('posts'));
    }

    public function getAdminPosts()
    {
        $sort_by = request()->sort ?? 'id';
        $order_by = request()->order_by ?? 'desc';
        $limit_by = request()->limit_by ?? 5;

        $posts = Post::where('user_id', null)->when(request()->keyword, function ($query) {
            $query->where('title', 'LIKE', '%' . request()->keyword . '%');
        })
            ->when(!is_null(request()->status), function ($query) {
                $query->where('status', request()->status);
            })
            ->orderBy($sort_by, $order_by)
            ->paginate($limit_by);
        return view('admin.posts.admin-posts', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfileRequest $request)
    {
        $request->validated();
        try {

            DB::beginTransaction();

            $post = Auth::guard('admin')->user()->posts()->create($request->except(['_token', 'images']));

            ImageManger::uploadImages($request, $post);

            DB::commit();
            Cache::forget('read_more_posts');
            Cache::forget('latest_posts');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong while creating the post');
        }
        return redirect()->back()->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $post = Post::findOrFail($id);
        // return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request, string $id)
    {
        // return $request;
        $post = Post::with('images')->where('id', $id)->first();
        if (!$post) {
            abort(404);
        }
        $request->validated();

        try {
            DB::beginTransaction();
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        try {
            DB::beginTransaction();
            ImageManger::deleteImages($post);
            $post->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong while deleting the post');
        }
        return redirect()->back()->with('success', 'Post Deleted Successfully');
    }

    public function changeStatus(string $id)
    {
        $post = Post::findOrFail($id);
        $post->status = !$post->status;
        $post->save();
        return redirect()->back()->with('success', 'Post Status Updated Successfully');
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
