<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $post = Post::first();

        if ($post) {
            Comment::updateOrCreate(
                [
                    'body' => 'いい記事ですね！',
                    'post_id' => $post->id,
                ],
                []
            );

            Comment::updateOrCreate(
                [
                    'body' => '勉強になりました！',
                    'post_id' => $post->id,
                ],
                []
            );
        }
    }
}