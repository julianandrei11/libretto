<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookGenreController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');
// Authors Routes
Route::resource('authors', AuthorController::class);

// Books Routes
Route::resource('books', BookController::class);




// Genres Routes
Route::resource('genres', GenreController::class);


// Reviews Routes
Route::resource('reviews', ReviewController::class);
