<?php

namespace App\Http\Controllers\Admin\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Notifications\SendOtpNotify;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
    protected $otp;
    public function __construct()
    {
        $this->otp = new Otp();
    }
    public function showForgetForm()
    {
        return view('admin.auth.password.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $admin = Admin::where('email', $request->email)->first();
        if (!$admin) {
            return back()->withErrors(['email' => 'Try again later.']);
        }

        $admin->notify(new SendOtpNotify());
        return redirect()->route('admin.password.verify.show', ['email'=>$request->email]);
    }

    public function showVerifyForm($email)
    {
        return view('admin.auth.password.confirm', compact('email'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:5',
        ]);

        $otp = $this->otp->validate($request->email, $request->otp);
        if($otp->status == false){
            return back()->withErrors(['otp' => 'Invalid OTP.']);
        }

        return redirect()->route('admin.password.reset.show', ['email'=>$request->email]);
    }
}
