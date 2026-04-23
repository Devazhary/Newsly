<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\Password\ForgetPasswordController;
use App\Http\Controllers\Admin\Auth\Password\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::controller(LoginController::class)->group(function(){
    Route::prefix('/login')->group(function(){
        Route::get('/', 'showLoginForm')->name('login.show');
        Route::post('/check', 'checkAuth')->name('login.check');
    });
    Route::post('/logout', 'logout')->name('logout');
});

Route::prefix('/password')->name('password.')->group(function(){
    Route::controller(ForgetPasswordController::class)->group(function(){
        Route::get('/forget', 'showForgetForm')->name('forget.show');
        Route::post('/forget', 'sendResetLinkEmail')->name('forget.send');
        Route::get('/verify/{email}', 'showVerifyForm')->name('verify.show');
        Route::post('/verifyOtp', 'verifyOtp')->name('verify.check');
    });

    Route::controller(ResetPasswordController::class)->group(function(){
        Route::get('/reset/{email}', 'showResetForm')->name('reset.show');
        Route::post('/resetPass', 'resetPassword')->name('reset.password'); 
    });
});

Route::middleware(['auth:admin'])->group(function(){
    Route::get('/dashboard', function(){
        return view('admin.index');
    })->name('dashboard');
});