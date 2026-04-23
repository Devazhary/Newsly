<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->only(['showLoginForm', 'checkAuth']);
        $this->middleware('auth:admin')->only('logout');
    }
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function checkAuth(Request $request)
    {
        //validation
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:8',
            'remember'=>'in:on,off',
        ]);

        //check auth
        if(!Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember == 'on' ? true : false)){
            return redirect()->back()->withErrors(['email' => 'Wrong Credentials']);
        }

        return redirect()->intended(route('admin.dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login.show');
    }
}
