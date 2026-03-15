<x-layout>
    <x-slot:title>
        Life & Tech Community
    </x-slot>

    <h1>Posts
        <a href="{{ route('posts.create') }}">Add new</a>
    </h1>
    <ul>
    @forelse ($posts as $index => $post)
        <li>
            <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
        </li>
    @empty
        <li>No post!</li>
    @endforelse
    </ul>
</x-layout>