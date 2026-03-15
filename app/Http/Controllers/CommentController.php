<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;


class CommentController extends Controller
{
    public function store(Request $request, Post $post) {

        $request->validate([
            'body'=>'required',
        ]);

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->post_id = $post->id;
        $comment->save();

        return redirect()->route('posts.show', $post);

    }

    public function destroy(Post $post, Comment $comment)
    {
        $comment->delete();

        return redirect()->route('posts.show', $post);
    }
}
