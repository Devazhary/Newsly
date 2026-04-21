<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest:admin'])->group(function(){
    Route::controller(LoginController::class)->prefix('/login')->group(function(){
        Route::get('/', 'showLoginForm')->name('login.show');
        Route::post('/check', 'checkAuth')->name('login.check');
    });
});

Route::middleware(['auth:admin'])->group(function(){
    Route::get('/dashboard', function(){
        return view('admin.index');
    })->name('dashboard');
});