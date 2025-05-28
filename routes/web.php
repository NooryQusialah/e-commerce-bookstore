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


Route::middleware([ 'auth:sanctum',config('jetstream.auth_session'),'verified',])->prefix('/admin/dashboard')->controller(AdminController::class)->group(function () {
    Route::get('/','index')->name('admin.dashboard');

    Route::controller(BookController::class)->group(function () {
       Route::get('/books', 'allBooks')->name('admin.books.index');
       Route::get('/books/create', 'create')->name('admin.books.create');
       Route::post('/books/store', 'store')->name('admin.books.store');
       Route::get('/books/{book}', 'showBook')->name('admin.books.show');
       Route::get('/books/{book}/edit', 'edit')->name('admin.books.edit');
       Route::put('/books/{book}', 'update')->name('admin.books.update');
       Route::delete('/books/{book}', 'destroy')->name('admin.books.destroy');
    });

    Route::controller(CategoryController::class)->group(function () {
       Route::get('/categories', 'allCategories')->name('admin.categories.index');
       Route::get('/categories/create', 'create')->name('admin.categories.create');
       Route::post('/categories/store', 'store')->name('admin.categories.store');
       Route::get('/categories/{category}', 'show')->name('admin.categories.show');
       Route::get('/categories/{category}/edit', 'edit')->name('admin.categories.edit');
       Route::put('/categories/{category}', 'update')->name('admin.categories.update');
       Route::delete('/categories/{category}', 'destroy')->name('admin.categories.destroy');

    });
});




