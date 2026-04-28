<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Utils\ImageManger;
use Illuminate\Http\Request;
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

        $posts = Post::when(request()->keyword, function ($query) {
            $query->where('title', 'LIKE', '%' . request()->keyword . '%');
        })
            ->when(!is_null(request()->status), function ($query) {
                $query->where('status', request()->status);
            })
            ->orderBy($sort_by, $order_by)
            ->paginate($limit_by);
        return view('admin.posts.index', compact('posts'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        try{
            DB::beginTransaction();
            ImageManger::deleteImages($post);
            $post->delete();
            DB::commit();
        }catch(\Exception $e){
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
}
