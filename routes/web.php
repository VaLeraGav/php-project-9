<?php

use App\Http\Controllers\UrlController;
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
