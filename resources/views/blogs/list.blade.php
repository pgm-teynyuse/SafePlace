<x-app-layout>
<x-slot name="header">
    <div class="flex justify-between items-center w-full">
        <h2 class="font-bold text-3xl text-gray-900 dark:text-white leading-tight">
            Blogs
        </h2>
        @if (Auth::check() && Auth::user()->role_id == 1)
            <div>
                <a href="/blogs/create" class="transform hover:bg-buttonSecondLight border-darkGreen border-solid border-2 text-darkGreen rounded-lg px-4 py-2 hover:bg-main transition duration-300">
                    <i class="fas fa-plus"></i>
                    Nieuwe blog
                </a>
            </div>
        @endif
    </div>
</x-slot>


    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach($blogs as $blog)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-6 hover:shadow-xl transition-shadow duration-300 ease-in-out">
            <div>
                <img src="{{ $blog->image_url }}" alt="Blog Image" class="rounded-lg">
            </div>    
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
                {{ $blog->title }}
                </h2>
                <p class="text-gray-600 dark:text-gray-400">
                    {{ Str::limit($blog->body, 100) }}
                </p>
                                <div class="mt-4 text-gray-500 dark:text-gray-300">
                    <i class="fas fa-user"></i>
                    {{ $blog->user->username }}
                </div>
                <div class="mt-4">
                    <a href="/blog/{{ $blog->id }}" class="mt-4 inline-block transform hover:bg-buttonSecondLight bg-buttonSecond text-purple-600 rounded px-4 py-2 hover:bg-purple-200 transition duration-300">  
                    Lees verder
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
