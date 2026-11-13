<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = collect();

    if (auth()->guard()->check()) {
        $posts = Post::with('user')->latest()->get();
    }

    return view('home', ['posts' => $posts]);
});

// Authentication & Profile routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
Route::get('/profile', [UserController::class, 'profile']);
Route::delete('/profile', [UserController::class, 'deleteAccount']);

// Blog post routes
Route::get('/posts/{post}', [PostController::class, 'showPost']);
Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostController::class, 'editPost']);
Route::put('/edit-post/{post}', [PostController::class, 'updatePost']);
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);
