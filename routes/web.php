<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('layouts.main');
})->middleware('auth:sanctum')->name('dashboard');;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('home');
});

Route::controller(BookController::class)->prefix('books')->group(function () {

    Route::get('/', 'index')->name('books.index');
    Route::get('/search', 'search')->name('books.search');
    Route::get('/details/{book}', 'show')->name('books.details');

});

