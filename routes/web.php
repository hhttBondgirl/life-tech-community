<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// 1. ブラウザの「Back」ボタンなどで使っている名前
Route::get('/', [CategoryController::class, 'index'])->name('posts.index');

// 2. GitHub Actionsや認証機能が求めている名前（中身は上と同じ）
Route::get('/home', [CategoryController::class, 'index'])->name('home');

Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::resource('posts', PostController::class)->except(['index']);
Route::resource('posts.comments', CommentController::class)->only(['store', 'destroy']);
