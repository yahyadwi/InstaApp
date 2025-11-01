<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);
});

// Auth routes
Route::middleware('auth')->group(function () {
    // Home/Feed
    Route::get('/', [PostController::class, 'index']);

    // Posts
    Route::get('/create', [PostController::class, 'create']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts/{post}', [PostController::class, 'show']);
    Route::post('/posts/{post}/like', [PostController::class, 'like']);
    Route::post('/posts/{post}/comment', [PostController::class, 'comment']);

    // Users
    Route::get('/profile/{username}', [UserController::class, 'profile']);
    Route::post('/users/{user}/follow', [UserController::class, 'follow']);

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);
});
