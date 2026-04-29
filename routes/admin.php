<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\Password\ForgetPasswordController;
use App\Http\Controllers\Admin\Auth\Password\ResetPasswordController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Post\PostController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\User\UserController;
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

    // User Routes
    Route::resource('user', UserController::class);
    Route::get('changeStatus/user/{id}', [UserController::class, 'changeStatus'])->name('user.changeStatus');
    // Category Routes
    Route::resource('categories', CategoryController::class);
    Route::get('changeStatus/category/{id}', [CategoryController::class, 'changeStatus'])->name('categories.changeStatus');

    // Post Routes
    Route::resource('posts', PostController::class);
    Route::get('/admin-post', [PostController::class, 'getAdminPosts'])->name('adminPosts');
    Route::get('changeStatus/post/{id}', [PostController::class, 'changeStatus'])->name('posts.changeStatus');
    Route::post('/post/delete-image', [PostController::class, 'deleteImage'])->name('post.delete.image');

    // Settings Routes
    Route::controller(SettingController::class)->prefix('/settings')->name('settings.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/update', 'update')->name('update');
    });

    Route::get('/dashboard', function(){
        return view('admin.index');
    })->name('dashboard');

});