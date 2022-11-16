<?php

use App\Http\Controllers\UrlController;
use App\Http\Controllers\UrlCheckController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');

Route::resource('urls', UrlController::class)->only('index', 'store', 'show');

Route::resource('urls.checks', UrlCheckController::class)->only('store');

