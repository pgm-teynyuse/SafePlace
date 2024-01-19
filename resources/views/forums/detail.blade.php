<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $forum->title }}
        </h2>
    </x-slot>

    <div class="flex">
        <!-- Linkerkolom voor Gerelateerde Blogs -->
        <div class="w-1/4 p-4">
            <h3 class="font-semibold text-lg mb-4">Gerelateerde Blogs</h3>
            @foreach ($relatedBlogs as $blog)
                <div class="mb-3 bg-white rounded-lg p-4 shadow">
                    <h4 class="font-semibold">{{ $blog->title }}</h4>
                    <p>{{ Str::limit($blog->body, 100) }}</p>
                    <!-- Blog Details -->
                </div>
            @endforeach
        </div>
<div class="w-3/4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <!-- Forum Details -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold mb-2">{{ $forum->title }}</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">{{ $forum->body }}</p>
            <div class="text-sm text-gray-500 dark:text-gray-300">
                Geplaatst door: {{ $forum->user->name }} op {{ $forum->created_at->format('d-m-Y H:i') }}
            </div>
        </div>
        <div>
            <form action="{{ route('answer', $forum->id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf
                <div class="mb-4 md:col-span-2">
                    <label for="body" class="block text-sm font-medium text-gray-700">Antwoord</label>
                    <textarea name="body" id="body" placeholder="Antwoord" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror">{{ old('body') }}</textarea>
                    @error('body')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <input type="hidden" name="forum_id" value="{{ $forum->id }}">
                <div class="md:col-span-2">
                    <button type="submit" class="inline-block transform hover:bg-buttonSecondLight bg-buttonSecond text-purple-600 rounded px-4 py-2 hover:bg-purple-200 transition duration-300 w-full">Publiceer</button>
                </div>
            </form>
        </div>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-2">Antwoorden</h3>
        @foreach ($replies as $answer)
            <div class="mb-4 border-b border-gray-200 pb-4">
                <p class="text-gray-600 dark:text-gray-400">{{ $answer->body }}</p>
                <div class="text-sm text-gray-500 dark:text-gray-300 mt-2">
                    Beantwoord door: {{ $answer->user->username }} op {{ $answer->created_at->format('d-m-Y H:i') }}
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>
</div>
</x-app-layout>
