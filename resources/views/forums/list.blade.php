<x-app-layout>
<x-slot name="header">
    <div class="flex justify-between items-center w-full">
        <h2 class="font-bold text-3xl text-gray-900 dark:text-white leading-tight">
            Forums
        </h2>
        <div>
            <a href="/forums/create" class="transform hover:bg-buttonSecondLight border-darkGreen border-solid border-2 text-darkGreen rounded-lg px-4 py-2 hover:bg-main transition duration-300">
                <i class="fas fa-plus"></i>
                Nieuwe forum
            </a>
        </div>
    </div>
</x-slot>

<div id="forumContainer">
    @foreach($forums as $forum)
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-6 hover:shadow-xl transition-shadow duration-300 ease-in-out forumCard" data-category="{{ $forum->category->name }}">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
                {{ $forum->title }}
            </h2>
            <p class="text-gray-600 dark:text-gray-400">
                {{ Str::limit($forum->body, 100) }}
            </p>
            <!-- Categorie Label -->
            <span class="inline-block rounded-full text-white px-3 py-1 text-sm font-semibold mr-2 mb-2"
                    style="background-color: {{ $forum->category->name == 'Cyber' ? '#8b5cf6' : ($forum->category->name == 'Work' ? '#10b981' : '#f59e0b') }}">
                {{ $forum->category->name }}
            </span>
            <div class="mt-4 text-gray-500 dark:text-gray-300">
                <i class="fas fa-user"></i>
                {{ $forum->user->username }}
            </div>
            <p class="text-gray-500">
                {{ $forum->created_at}}
            </p>
            <div class="mt-4">
                <a href="/forum/{{ $forum->id }}" class="mt-4 inline-block transform hover:bg-buttonSecondLight bg-buttonSecond text-purple-600 rounded px-4 py-2 hover:bg-purple-200 transition duration-300">  
                    Bekijk antwoorden
                </a>
                <a href="/forum/{{ $forum->id }}" class="mt-4 inline-block transform hover:bg-buttonSecondLight bg-buttonSecond text-purple-600 rounded px-4 py-2 hover:bg-purple-200 transition duration-300">  
                    Geef antwoord
                </a>
            </div>
        </div>
    @endforeach
</div>

</x-app-layout>
