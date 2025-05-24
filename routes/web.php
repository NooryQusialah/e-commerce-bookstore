<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;
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

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('categories.index');
        Route::get('/category/search', 'search')->name('categories.search');
        Route::get('/category/{category}', 'BooksCategories')->name('books.categories.index');

    });

    Route::controller(PublisherController::class)->group(function () {

        Route::get('/publishers', 'index')->name('publishers.index');
        Route::get('/publishers/search', 'search')->name('publishers.search');
        Route::get('/publisher/{publisher}', 'BooksPublishers')->name('books.publishers.index');

    });

    Route::controller(AuthorController::class)->group(function () {
        Route::get('/authors', 'index')->name('authors.index');
        Route::get('/authors/search', 'search')->name('authors.search');
        Route::get('/author/{author}', 'BooksAuthors')->name('books.authors.index');

    });

});


Route::middleware([ 'auth:sanctum',config('jetstream.auth_session'),'verified',])->controller(AdminController::class)->group(function () {
    Route::get('/admin/dashboard','index')->name('admin.dashboard');
});




