<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use Illuminate\Support\Facades\Auth;


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('frontend.index');

