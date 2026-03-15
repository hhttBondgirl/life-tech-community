<x-layout>
    <x-slot:title>
        Add new post | My Laravel App
    </x-slot>

    <h1>Add new post</h1>
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <div>        
            <label>
            Title
            <input type = "text" name="title" value="{{ old('title') }}">
             </label>
             @error('title')
                <p class="error">{{ $message }}</p>
             @enderror
         </div>
        <div>
            <label>
            Body
            <textarea name="body">{{ old('body') }}</textarea>
             </label>
             @error('body')
                <p class="error">本文の入力は必須です。</p>
             @enderror
        </div>

        <div>
            <button type="submit">Add</button>
        </div>
    </form>
    <p class="back-link"><a href="{{ route('posts.index') }}">Back</a></p>
</x-layout>