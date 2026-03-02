<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\NewsSubsController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\frontend\CategoryController;
use App\Http\Controllers\frontend\PostController;



Auth::routes();
Route::name('frontend.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/news-subs', [NewsSubsController::class, 'store'])->name('news-subs');
    Route::get('/category/{slug}', CategoryController::class)->name('category.posts');
    Route::get('/post/{slug}', [PostController::class, 'show'])->name('post.show');
    Route::get('/post/comments/{slug}', [PostController::class, 'getAllComments'])->name('post.getAllComments');
    Route::post('/post/comments/store', [PostController::class, 'storeComments'])->name('post.comments.store');
});