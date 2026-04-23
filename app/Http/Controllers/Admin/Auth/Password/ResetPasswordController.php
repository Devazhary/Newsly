<?php

namespace App\Http\Controllers\Admin\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function showResetForm($email)
    {
        return view('admin.auth.password.reset', compact('email'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $admin = Admin::where('email', $request->email)->first();
        if (!$admin) {
            return redirect()->back()->withErrors(['password' => 'Wrong credentials. Please try again.']);
        }
        
        $admin->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.login.show')->with('success', 'Password has been reset successfully. Please login with your new password.');
    }
}
