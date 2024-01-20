<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-900 dark:text-white leading-tight">Blogs</h2>
    </x-slot>

    <div class="bg-gray-100 dark:bg-gray-700 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
            <div>
            <form action="{{ route('blogs.search') }}" class="flex" method="GET">
                <input type="text" name="query" id="search" placeholder="Zoek blog..." class="form-control w-full border border-gray-300 rounded-md">
                <button type="submit" class="ml-2 bg-darkGreen text-main hover:bg-main hover:text-darkGreen font-bold py-2 px-4 rounded">
                    Zoeken
                </button>
            </form>

            </div>
                <div class="category-buttons flex flex-wrap gap-2 ">
                <a href="/blogs" class="{{ request()->is('blogs') ? 'bg-darkGreen text-main' : 'bg-main text-darkGreen dark:bg-white' }} hover:bg-darkGreen hover:text-main font-bold py-2 px-4 rounded">
                    Alle categorieën
                </a>
                @foreach($categories as $category)
                    <a href="/blogs/category/{{ $category->id }}" class="{{ request()->is('blogs/category/' . $category->id) ? 'bg-darkGreen text-main' : 'bg-main text-darkGreen dark:bg-white' }} hover:bg-darkGreen hover:text-main font-bold py-2 px-4 rounded">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
            
                        @if (Auth::check() && Auth::user()->role_id == 1)
                <div>
                    <a href="/blogs/create" class="transform hover:bg-buttonSecondLight border-darkGreen border-solid border-2 text-darkGreen rounded-lg px-4 py-2 hover:bg-main transition duration-300">
                        <i class="fas fa-plus"></i>
                        Nieuwe blog
                    </a>
                </div>
            @endif
        </div>

    <div id="blog-container" class="max-w-7xl mx-auto grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 mt-6 px-6">
        @foreach($blogs as $blog)
            <div class="blog-card bg-white dark:bg-gray overflow-hidden shadow rounded-lg" data-category="{{ $blog->category->id }}">
                <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="w-full h-48 object-cover rounded-t-lg">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">
                        {{ $blog->title }}
                    </h2>
                    <span class="bg-main text-black dark:bg-white rounded-full px-3 py-1 text-sm font-semibold">
                        <i class="fas fa-user"></i>
                        {{($blog->user->username) }}</span>
                        <span class="bg-main text-black dark:bg-white rounded-full px-3 py-1 text-sm font-semibold">
                            <i class="fas fa-hashtag"></i>
                            {{ $blog->category->name }}
                        </span>
                    <p class="text-gray-600 mt-5 dark:text-gray-400 mb-4">
                        {{ Str::limit($blog->body, 100) }}
                    </p>
                    <div class="flex justify-between items-center">
                    
                        <a href="/blog/{{ $blog->id }}" class="mt-4 inline-block transform hover:bg-buttonSecondLight bg-buttonSecond text-purple-600 rounded px-4 py-2 hover:bg-purple-200 transition duration-300">  
                            Lees verder
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
