<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Blogs
        </h2>
    <div>
        <a href="/blogs/create" class="text-white py-2 px-4 border border-indigo-500 rounded-lg">Nieuwe Blog</a>
    </div>
    </x-slot>

    <div id="blogs" class=" max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8  grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach($blogs as $blog)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
                    <a href="/blog/{{ $blog->id }}" class="hover:text-indigo-500">{{ $blog->title }}</a>
                </h2>
                <p class="text-gray-600 dark:text-gray-400">
                    {{ Str::limit($blog->body, 100) }}
                </p>
                <div class="mt-4 text-gray-500 dark:text-gray-300">
                    Auteur: {{ $blog->user->name }}
                </div>
                <div class="mt-4">
                    <a href="/blog/{{ $blog->id }}" class="text-white py-2 px-4 border border-indigo-500 rounded-lg">Lees Meer</a>
                </div>

            </div>
        @endforeach
    </div>
</x-app-layout>
