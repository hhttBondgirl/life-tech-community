<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    // public function index()
    // {
    //     return view('posts.index');
    // }

    public function index()
{
    $posts = Post::latest()->get();
    $categories = Category::all();
    $selectedCategory = null;

    return view('posts.index', compact('posts', 'categories', 'selectedCategory'));
}

    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
    }

    public function create()
    {
        return view('posts.create')->with([
            'categories' => Category::query()->orderBy('name')->get(),
        ]);
    }

    public function store(PostRequest $request)
    {

        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category_id;
        $post->save();

        return redirect()->route('categories.show', $post->category);
    }

    public function edit(Post $post)
    {
        return view('posts.edit')->with([
            'post' => $post,
            'categories' => Category::query()->orderBy('name')->get(),
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {

        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category_id;
        $post->save();

        return redirect()->route('posts.show', $post);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index');
    }
}
