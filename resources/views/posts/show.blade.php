<x-layout>
    <x-slot:title>
        {{ $post->title }} | My Laravel App
    </x-slot>

    <h1>{{ $post->title }}
    <a href="{{ route('posts.edit', $post) }}">Edit</a>
    <form method="POST" action="{{ route('posts.destroy', $post) }}" id = "delete-form">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    </h1>
   
    <p>
        Category:
        @if ($post->category)
            <a href="{{ route('categories.show', $post->category) }}">{{ $post->category->name }}</a>
        @else
            (none)
        @endif
    </p>

    <p>{!! nl2br(e($post->body))!!}</p>

    <h2>Comments</h2>
    <ul>
        @forelse ($post->comments as $comment)
            <li>
                {{ $comment->body }}
                <form method = "post" action = "{{ route('posts.comments.destroy', [$post, $comment])}}" class = "comment-delete-form">
                    @csrf
                    @method('DELETE')
                    <button>Delete</button>
                </form>
            </li>
        @empty
            <li>No comments yet.</li>
        @endforelse
    </ul>

    <h2>Add a comment</h2>
    <form method = "post" action="{{ route('posts.comments.store', $post) }}">
        @csrf
        <div>
            <input type = "text" name = "body">
            @error('body')
            <p class = "error">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <button>Add</button>
        </div>
    </form>
    <p class="back-link"><a href="{{ route('posts.index') }}">Back</a></p>

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