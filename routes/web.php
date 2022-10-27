<?php

use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// запись и вывод url
//Route::get('/urls', [UrlController::class, 'index'])
//    ->name('index');
//
//Route::post('urls', [UrlController::class, 'store'])
//    ->name('store');

Route::resource('urls', UrlController::class)->only([
    'index', 'store', 'show'
]);

