<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\NewsSubsController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\frontend\CategoryController;
use App\Http\Controllers\frontend\PostController;
use App\Http\Controllers\frontend\ContactController;



Auth::routes();
Route::name('frontend.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/news-subs', [NewsSubsController::class, 'store'])->name('news-subs');
    Route::get('/category/{slug}', CategoryController::class)->name('category.posts');

    //PostController Route
    Route::controller(PostController::class)->prefix('post')->name('post.')->group(function () {
        Route::get('/{slug}',  'show')->name('show');
        Route::get('/comments/{slug}',  'getAllComments')->name('getAllComments');
        Route::post('/comments/store',  'storeComments')->name('comments.store');
    });

    //ContactController Route
    Route::controller(ContactController::class)->prefix('contact')->name('contact.')->group(function () {
        Route::get('/', 'index')->name('show');
        Route::post('/store', 'store')->name('store');
    });
});
