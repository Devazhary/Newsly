<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\NewsSubsController;
use Illuminate\Support\Facades\Auth;


Auth::routes();
Route::name('frontend.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/news-subs', [NewsSubsController::class, 'store'])->name('news-subs');
});