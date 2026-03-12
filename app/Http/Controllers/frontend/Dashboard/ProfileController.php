<?php

namespace App\Http\Controllers\frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Utils\ImageManger;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index()
    {
        return view('frontend.dashboard.profile');
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
}
