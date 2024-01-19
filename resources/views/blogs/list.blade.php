<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="font-bold text-3xl text-gray-900 dark:text-white leading-tight">Blogs</h2>
            @if (Auth::check() && Auth::user()->role_id == 1)
                <div>
                    <a href="/blogs/create" class="transform hover:bg-buttonSecondLight border-darkGreen border-solid border-2 text-darkGreen rounded-lg px-4 py-2 hover:bg-main transition duration-300">
                        <i class="fas fa-plus"></i>
                        Nieuwe blog
                    </a>
                </div>
            @endif
        </div>
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <input type="text" id="search" placeholder="Zoek blog" class="form-control w-full p-2 border border-gray-300 rounded-md">
</div>
    </x-slot>


    <div id="blog-container" class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
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
                <span class="inline-block rounded-full text-white px-3 py-1 text-sm font-semibold mr-2 mb-2"
                    style="background-color: {{ $blog->category->name == 'Cyber' ? '#8b5cf6' : ($blog->category->name == 'Work' ? '#10b981' : '#f59e0b') }}">
                {{ $blog->category->name }}
            </span>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var query = $(this).val();
            $.ajax({
                url: "{{ route('blogs.search') }}",
                type: "GET",
                data: {'query': query},
                success: function(data) {
                    $('#blog-container').html('');
                    $.each(data, function(index, blog) {
                        var blogHtml = '<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-6 hover:shadow-xl transition-shadow duration-300 ease-in-out">' +
                            '<div><img src="' + blog.image_url + '" alt="Blog Image" class="rounded-lg"></div>' +
                            '<h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">' + blog.title + '</h2>' +
                            '<p class="text-gray-600 dark:text-gray-400">' + blog.body.substring(0, 100) + '...</p>' +
                            '<div class="mt-4"><a href="/blog/' + blog.id + '" class="mt-4 inline-block transform hover:bg-buttonSecondLight bg-buttonSecond text-purple-600 rounded px-4 py-2 hover:bg-purple-200 transition duration-300">Lees verder</a></div>' +
                            '</div>';
                        $('#blog-container').append(blogHtml);
                    });
                }
            });
        });
    });
</script>

