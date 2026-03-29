<x-layout>
    <x-slot:title>
        {{ $post->title }} | Techと暮らしのサロン
    </x-slot>

    <h1>{{ $post->title }}
    <a class = "edit-link" href="{{ route('posts.edit', $post) }}">修正する</a>
    <form method="POST" action="{{ route('posts.destroy', $post) }}" id = "delete-form">
        @csrf
        @method('DELETE')
        <button type="submit" class="delete-button">削除する</button>
    </form>
    </h1>
   
    <p class = "show-category">
        カテゴリー:
        @if ($post->category)
            <a href="{{ route('categories.show', $post->category) }}">{{ $post->category->name }}</a>
        @else
            (none)
        @endif
    </p>

    <p>{!! nl2br(e($post->body))!!}</p>

    <h2>レス一覧</h2>
    <ul>
        @forelse ($post->comments as $comment)
            <li>
                {{ $comment->body }}
                <form method = "post" action = "{{ route('posts.comments.destroy', [$post, $comment])}}" class = "comment-delete-form">
                    @csrf
                    @method('DELETE')
                    <button class="delete-button">削除する</button>
                </form>
            </li>
        @empty
            <li>レスはまだありません。</li>
        @endforelse
    </ul>

    <h2>レスする</h2>
    <form method = "post" action="{{ route('posts.comments.store', $post) }}">
        @csrf
        <div>
            <input type = "text" name = "body">
            @error('body')
            <p class = "error">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <button>レスを追加する</button>
        </div>
    </form>
    <p class="back-link"><a href="{{ route('posts.index') }}">Topへ戻る</a></p>

    <script>
        document.getElementById('delete-form').addEventListener('submit', function(event) {
            event.preventDefault();
            if (confirm('Are you sure you want to delete this post?')) {
                this.submit();
            }
        });

        const commentForms = document.querySelectorAll('.comment-delete-form');
        commentForms.forEach((commentForm) => {
            commentForm.addEventListener('submit', (e) => {
                e.preventDefault();
                if(confirm('Sure?') === false) {
                    return;
                }
                commentForm.submit();
            });
        });
    </script>
</x-layout>