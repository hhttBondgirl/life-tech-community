<?php

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;

test('カテゴリをクリックすると該当カテゴリの投稿だけ表示される', function () {
    $tech = Category::factory()->create([
        'name' => 'Tech',
        'slug' => 'tech',
    ]);

    $design = Category::factory()->create([
        'name' => 'Design',
        'slug' => 'design',
    ]);

    $techPost = Post::factory()->create([
        'title' => 'Tech Post',
        'category_id' => $tech->id,
    ]);

    $designPost = Post::factory()->create([
        'title' => 'Design Post',
        'category_id' => $design->id,
    ]);

    $response = $this->get(route('categories.show', $tech));

    $response->assertOk();
    $response->assertSee($techPost->title);
    $response->assertDontSee($designPost->title);
});

test('カテゴリ一覧は指定順で固定される', function () {
    $tech = Category::factory()->create(['name' => 'Tech', 'slug' => 'tech', 'sort_order' => 1]);
    $design = Category::factory()->create(['name' => 'Design', 'slug' => 'design', 'sort_order' => 2]);
    $lifestyle = Category::factory()->create(['name' => 'Lifestyle', 'slug' => 'lifestyle', 'sort_order' => 3]);
    $dogs = Category::factory()->create(['name' => 'Dogs', 'slug' => 'dogs', 'sort_order' => 4]);
    $movies = Category::factory()->create(['name' => 'Movies', 'slug' => 'movies', 'sort_order' => 5]);

    $response = $this->get(route('categories.show', $tech));
    $response->assertOk();

    $html = $response->getContent();
    expect(strpos($html, $tech->name))->toBeLessThan(strpos($html, $design->name));
    expect(strpos($html, $design->name))->toBeLessThan(strpos($html, $lifestyle->name));
    expect(strpos($html, $lifestyle->name))->toBeLessThan(strpos($html, $dogs->name));
    expect(strpos($html, $dogs->name))->toBeLessThan(strpos($html, $movies->name));
});

test('投稿一覧にコメント数が表示される', function () {
    $tech = Category::factory()->create(['name' => 'Tech', 'slug' => 'tech', 'sort_order' => 1]);

    $post = Post::factory()->create([
        'title' => 'Tech Post',
        'category_id' => $tech->id,
        'created_at' => Carbon::create(2026, 3, 17, 10, 0, 0),
    ]);

    Comment::factory()->count(2)->create(['post_id' => $post->id]);

    $response = $this->get(route('categories.show', $tech));

    $response->assertOk();
    $response->assertSee('2');
    $response->assertSee('2026年3月17日');
});
