<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // 未ログイン時は必ずログイン画面へ
    Route::get('/', function () {
        return redirect()->route('login');
    });
});

Route::middleware('auth')->group(function () {
    // ログイン後のトップは掲示板（左カテゴリ・右投稿一覧）
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/posts', [CategoryController::class, 'index'])->name('posts.index');
    Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

    // Breeze 標準のプロフィール関連
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 投稿関連（一覧(index)は上で `CategoryController@index` を使うため除外）
    Route::resource('posts', PostController::class)->except(['index']);

    // コメントは posts.show 側から store/destroy を使う
    Route::resource('posts.comments', CommentController::class)->only(['store', 'destroy']);
});

Route::get('/init', function () {
    \App\Models\Category::create([
        'name' => 'Tech',
        'slug' => 'tech',
    ]);

    \App\Models\Post::create([
        'title' => 'はじめての投稿',
        'body' => 'Railwayデプロイ成功！',
        'category_id' => 1,
    ]);

    return 'ok';
});

require __DIR__.'/auth.php';
