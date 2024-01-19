<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $blog->title }}
        </h2>
        @if (Auth::check() && Auth::user()->id == $blog->user_id) 
        <div class="flex align-middle justify-between">
            <a href="/blog/{{ $blog->id }}/edit" class="mr-4 transform hover:bg-buttonSecondLight border-buttonSecond border-solid border-2 text-primary rounded-lg px-4 py-2 hover:bg-purple-200 transition duration-300">
                <i class="fas fa-edit"></i>
                Bewerk
            </a>
            <form action="/blogs/{{ $blog->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="transform hover:bg-redLight border-red border-solid border-2 text-redDark rounded-lg px-4 py-2 hover:bg-purple-200 transition duration-300">
                    <i class="fas fa-trash-alt"></i>
                    Verwijder
                </button>
            </form>
        </div>
        @endif
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






