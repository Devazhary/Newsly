<?php

namespace App\Http\Controllers\frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\SettingRequest;
use App\Models\User;
use App\Utils\ImageManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function index()
    {
        $user = auth()->guard('web')->user();
        return view('frontend.dashboard.setting', compact('user'));
    }

    public function update(SettingRequest $request)
    {
        $request->validated();
        $user = User::findOrFail(auth('web')->user()->id);
        $user->update($request->except(['_token', 'image']));

        ImageManger::uploadImages($request, null, $user);

        Session::flash('success', 'Profile Setting Updated Successfully');
        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);

        $user = User::findOrFail(auth('web')->user()->id);
        $password = $user->password;

        if (!Hash::check($request->current_password, $password)) {
            Session::flash('error', 'Wrong Password Please Try Again!');
            return redirect()->back();
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        Session::flash('success', 'Password Updated Successfully');
        return redirect()->back();
    }
}
