<?php

use App\Http\Controllers\UrlController;
use App\Http\Controllers\UrlCheckController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::resource('urls', UrlController::class)->only([
        'index',
        'store',
        'show'
    ]
);

// Route::post('urls/{id}/checks', UrlCheckController::class)->only('store');
