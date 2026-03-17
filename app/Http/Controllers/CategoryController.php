<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): RedirectResponse|View
    {
        $first = Category::query()
            ->orderByRaw('sort_order is null')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->first();

        if ($first === null) {
            return view('index', [
                'categories' => collect(),
                'selectedCategory' => null,
                'posts' => collect(),
            ]);
        }

        return redirect()->route('categories.show', $first);
    }

    public function show(Category $category): View
    {
        $categories = Category::query()
            ->orderByRaw('sort_order is null')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $posts = Post::query()
            ->where('category_id', $category->id)
            ->withCount('comments')
            ->latest()
            ->get();

        return view('index', [
            'categories' => $categories,
            'selectedCategory' => $category,
            'posts' => $posts,
        ]);
    }
}
