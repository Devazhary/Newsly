<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\NewsSubsController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\frontend\CategoryController;


Auth::routes();
Route::name('frontend.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/news-subs', [NewsSubsController::class, 'store'])->name('news-subs');
    Route::get('/category/{slug}', CategoryController::class)->name('category.posts');
});