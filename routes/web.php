<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;


Route::get('/', [PostController::class, 'index'])->name('posts.index');

// Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::resource('posts', PostController::class)->except(['index']);
Route::resource('posts.comments', CommentController::class)->only(['store', 'destroy']);