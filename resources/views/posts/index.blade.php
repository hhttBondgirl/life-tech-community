<x-layout>
    <x-slot:title>
        Techと暮らしのサロン
        </x-slot>

        @php
            $categoryIcons = [
                'tech' => asset('img/pc.svg'),
                'design' => asset('img/design.svg'),
                'lifestyle' => asset('img/house.svg'),
                'dogs' => asset('img/dog.svg'),
                'movies' => asset('img/movie.svg'),
            ];
        @endphp

        <div class="board-header">
            <div class="board-header-left">
                <h1>
                    <a href="{{ route('posts.index') }}">
                        <img src="{{ asset('img/logo.svg') }}" alt="Techと暮らしのサロン">
                    </a>
                </h1>
                <div class="header-menu">
                    <a href="#">ランキング</a>
                    <a href="#">新着順</a>
                    <a href="#">マイページ作成</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            style="background:none; border:none; color:inherit; cursor:pointer; padding:0;">
                            ログアウト
                        </button>
                    </form>
                </div>
            </div>
            <div class="board-header-right">
                <a href="{{ route('posts.create') }}">投稿を追加</a>
            </div>
        </div>


        <div class="board-layout">
            <aside class="board-sidebar">
                <h2>カテゴリー</h2>
                <ul class="category-list">
                    @forelse ($categories as $category)
                        <li>
                            <a class="category-link {{ $selectedCategory?->is($category) ? 'is-active' : '' }}"
                                href="{{ route('categories.show', $category) }}">

                                <span class="category-icon" aria-hidden="true">
                                    @if(isset($categoryIcons[$category->slug]))
                                        <img src="{{ $categoryIcons[$category->slug] }}" alt="" width="24" height="24">
                                    @endif
                                </span>
                                {{ $category->name }}
                            </a>
                        </li>
                    @empty
                        <li>No categories yet.</li>
                    @endforelse
                </ul>
            </aside>

            <main class="board-main">
                <h2>投稿一覧</h2>
                <ul class="post-list">
                    @forelse ($posts as $post)
                        <li class="post-item">
                            <a class="post-title" href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                            <div class="post-meta">
                                <span class="post-meta-item">
                                    <span class="post-meta-icon" aria-hidden="true">
                                        <img src="{{ asset('img/chat.svg') }}" alt="" width="16" height="16">
                                    </span>
                                    {{ $post->comments_count ?? 0 }}
                                </span>
                                <span class="post-meta-separator" aria-hidden="true">·</span>
                                <time datetime="{{ $post->created_at?->toDateString() }}">
                                    {{ $post->created_at?->format('Y年n月j日') }}
                                </time>
                            </div>
                        </li>
                    @empty
                        <li class="post-item">まだ投稿がありません。</li>
                    @endforelse
                </ul>
            </main>
        </div>
</x-layout>