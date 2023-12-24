<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $blog->title }}
        </h2>
        <div class="flex align-middle" >
            <form action="/blogs/{{ $blog->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="text-white py-2 px-4 border border-indigo-500 rounded-lg">Verwijder Blog</button>
            </form>
            <a href="/blog/{{ $blog->id }}/edit" class="text-white py-2 px-4 border border-indigo-500 rounded-lg">Edit Blog</a>
        </div>
    </x-slot>

    <div id="blogs" class=" max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8  grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        <div>
            <div>
            <p>
                Author: {{ $blog->user->username }}
            </p>
            <p>
                Created: {{ $blog->created_at }}
            </p>
            </div>
            <p class=" text-white">
                {{ $blog->body }}
            </p>
        </div>
    </div>
    

</x-app-layout>






