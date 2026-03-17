<x-layout>
    <x-slot:title>
        Life & Tech Community
    </x-slot>

    @php
        $categoryIcons = [
            // Computer (Tech)
            'tech' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 5.5A2.5 2.5 0 0 1 6.5 3h11A2.5 2.5 0 0 1 20 5.5V15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5.5Z" stroke="currentColor" stroke-width="1.7"/><path d="M8 21h8" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="M12 17v4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
            // Palette (Design)
            'design' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 3a9 9 0 1 0 0 18h2.2a2.3 2.3 0 0 0 0-4.6H13a2 2 0 0 1 0-4h3.2A4.8 4.8 0 0 0 21 7.6 9 9 0 0 0 12 3Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M7.5 10.2h.01" stroke="currentColor" stroke-width="3" stroke-linecap="round"/><path d="M10.2 7.7h.01" stroke="currentColor" stroke-width="3" stroke-linecap="round"/><path d="M14 7.7h.01" stroke="currentColor" stroke-width="3" stroke-linecap="round"/><path d="M16.7 10.2h.01" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>',
            // Home (Lifestyle)
            'lifestyle' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 10.8 12 4l8 6.8V20a1.7 1.7 0 0 1-1.7 1.7H5.7A1.7 1.7 0 0 1 4 20v-9.2Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M9 21.7V14a1.5 1.5 0 0 1 1.5-1.5h3A1.5 1.5 0 0 1 15 14v7.7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
            // Dog (Dogs)
            'dogs' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7.2 10.1c.9 0 1.6-.8 1.6-1.7S8.1 6.7 7.2 6.7 5.6 7.5 5.6 8.4s.7 1.7 1.6 1.7Z" fill="currentColor"/><path d="M12 8.8c.9 0 1.6-.8 1.6-1.7S12.9 5.4 12 5.4s-1.6.8-1.6 1.7.7 1.7 1.6 1.7Z" fill="currentColor"/><path d="M16.8 10.1c.9 0 1.6-.8 1.6-1.7S17.7 6.7 16.8 6.7s-1.6.8-1.6 1.7.7 1.7 1.6 1.7Z" fill="currentColor"/><path d="M9.1 10.8c.9 0 1.6-.8 1.6-1.7S10 7.4 9.1 7.4s-1.6.8-1.6 1.7.7 1.7 1.6 1.7Z" fill="currentColor"/><path d="M14.9 10.8c.9 0 1.6-.8 1.6-1.7s-.7-1.7-1.6-1.7-1.6.8-1.6 1.7.7 1.7 1.6 1.7Z" fill="currentColor"/><path d="M12 20.2c2.6 0 4.7-1.8 4.7-4.1 0-2.2-1.8-4-4.4-4-.8 0-1.7.2-2.3.6-.7-.4-1.5-.6-2.3-.6-2.6 0-4.4 1.8-4.4 4 0 2.3 2.1 4.1 4.7 4.1.8 0 1.5-.2 2.1-.5.6.3 1.3.5 2.1.5Z" fill="currentColor"/></svg>',
            // Film (Movies)
            'movies' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4.5 7A2.5 2.5 0 0 1 7 4.5h10A2.5 2.5 0 0 1 19.5 7v10A2.5 2.5 0 0 1 17 19.5H7A2.5 2.5 0 0 1 4.5 17V7Z" stroke="currentColor" stroke-width="1.7"/><path d="M8 4.6v14.8" stroke="currentColor" stroke-width="1.7"/><path d="M16 4.6v14.8" stroke="currentColor" stroke-width="1.7"/><path d="M4.6 8h14.8" stroke="currentColor" stroke-width="1.7"/><path d="M4.6 16h14.8" stroke="currentColor" stroke-width="1.7"/></svg>',
        ];
    @endphp

    <div class="board-header">
        <h1>
            {{ $selectedCategory?->name ?? 'Posts' }}
        </h1>
        <a href="{{ route('posts.create') }}">Add new</a>
    </div>

    <div class="board-layout">
        <aside class="board-sidebar">
            <h2>Categories</h2>
            <ul class="category-list">
                @forelse ($categories as $category)
                    <li>
                        <a
                            class="category-link {{ $selectedCategory?->is($category) ? 'is-active' : '' }}"
                            href="{{ route('categories.show', $category) }}"
                        >
                            <span class="category-icon" aria-hidden="true">
                                {!! $categoryIcons[$category->slug] ?? '' !!}
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
            <h2>Posts</h2>
            <ul class="post-list">
                @forelse ($posts as $post)
                    <li class="post-item">
                        <a class="post-title" href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                        <div class="post-meta">
                            <span class="post-meta-item">
                                <span class="post-meta-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none">
                                        <path d="M20 12a7 7 0 0 1-7 7H8l-4 2 1.2-4.2A7 7 0 1 1 20 12Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                                    </svg>
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
                    <li class="post-item">No post!</li>
                @endforelse
            </ul>
        </main>
    </div>
</x-layout>