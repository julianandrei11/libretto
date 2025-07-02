<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BookGenreController;
use App\Http\Controllers\RegisterController;

Route::post('/register', [RegisterController::class, 'register']);


// 🔓 Public route for login
Route::post('/login', [AuthController::class, 'login']);

// 🔐 Sanctum-protected routes (no need to modify Kernel.php for this)
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('books', BookController::class);
    Route::apiResource('authors', AuthorController::class);
    Route::apiResource('genres', GenreController::class);
    Route::apiResource('reviews', ReviewController::class);
    Route::apiResource('book-genres', BookGenreController::class);
});
