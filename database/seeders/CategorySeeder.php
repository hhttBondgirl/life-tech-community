<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Tech', 'sort_order' => 1],
            ['name' => 'Design', 'sort_order' => 2],
            ['name' => 'Lifestyle', 'sort_order' => 3],
            ['name' => 'Dogs', 'sort_order' => 4],
            ['name' => 'Movies', 'sort_order' => 5],
        ];

        $techCategory = null;

        foreach ($categories as $data) {
            $name = $data['name'];

            $category = Category::query()->updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'sort_order' => $data['sort_order'],
                ],
            );

            if ($category->slug === 'tech') {
                $techCategory = $category;
            }
        }

        if ($techCategory !== null) {
            Post::query()
                ->whereNull('category_id')
                ->update(['category_id' => $techCategory->id]);
        }
    }
}
