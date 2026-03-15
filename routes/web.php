<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

// 1. ブラウザの「Back」ボタンなどで使っている名前
Route::get('/', [PostController::class, 'index'])->name('posts.index');

// 2. GitHub Actionsや認証機能が求めている名前（中身は上と同じ）
Route::get('/home', [PostController::class, 'index'])->name('home');

Route::resource('posts', PostController::class)->except(['index']);
Route::resource('posts.comments', CommentController::class)->only(['store', 'destroy']);