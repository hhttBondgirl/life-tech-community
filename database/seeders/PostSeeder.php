<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $tech = Category::where('slug', 'tech')->first();

        if ($tech) {
            Post::updateOrCreate(
                ['title' => 'はじめての投稿'],
                [
                    'body' => 'よろしくお願いします！',
                    'category_id' => $tech->id,
                ]
            );

            Post::updateOrCreate(
                ['title' => 'Laravel楽しい'],
                [
                    'body' => 'デプロイできた！',
                    'category_id' => $tech->id,
                ]
            );
        }
    }
}