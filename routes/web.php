<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookGenreController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ReviewController;

// Home route
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.show');


// Authors CRUD
Route::resource('authors', AuthorController::class);

// Books CRUD
Route::resource('books', BookController::class);

// Genres CRUD
Route::resource('genres', GenreController::class);

// Reviews CRUD
Route::resource('reviews', ReviewController::class);
