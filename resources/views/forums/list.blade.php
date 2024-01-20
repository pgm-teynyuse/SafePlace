<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="font-bold text-3xl text-gray-900 dark:text-white leading-tight">
                Forums
            </h2>
            <div>
                <a href="/forums/create" class="transform hover:bg-buttonSecondLight border-darkGreen border-solid border-2 text-darkGreen rounded-lg px-4 py-2 hover:bg-main transition duration-300">
                    <i class="fas fa-plus mr-2"></i> Nieuwe Forum
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="flex justify-between mb-6">
            <div class="flex items-center">
            <form action="{{ route('forums.search') }}" method="GET" class="flex border mr-14 border-gray rounded overflow-hidden">
                <input type="text" name="query" placeholder="Zoek in forums..." class="px-4 py-2 w-full">
                <button type="submit" class="flex items-center justify-center px-4 border-l bg-gray-200">
                    <i class="fas fa-search text-gray"></i>
                </button>
            </form>
            <div class="flex">
                <a href="/forums" class="{{ request()->is('forums') && !request()->has('sort') ? 'border border-gray' : 'bg-main text-darkGreen dark:text-dark dark:bg-main' }} mr-2  hover:bg-dark hover:text-main dark:text-main font-bold py-2 px-4 rounded">
                    Nieuw
                </a>
                <a href="/forums?sort=popular" class="{{ request()->is('forums') && request()->query('sort') === 'popular' ? 'border border-gray' : 'bg-main text-darkGreen dark:text-dark dark:bg-main' }} mr-2   hover:bg-dark hover:text-main dark:text-main font-bold py-2 px-4 rounded">
                    Populair
                </a>
                <a href="/forums?sort=oldest" class="{{ request()->is('forums') && request()->query('sort') === 'oldest' ? 'border border-gray' : 'bg-main text-darkGreen dark:text-dark dark:bg-main' }} mr-2   hover:bg-dark hover:text-main dark:text-main font-bold py-2 px-4 rounded">
                    Oud
                </a>
        </div>
        </div>
            <div class="flex gap-2">
                <a href="/forums" class="{{ request()->is('forums') ? 'border border-gray' : 'bg-main text-darkGreen dark:text-dark dark:bg-main' }}  hover:bg-dark hover:text-main dark:text-main font-bold py-2 px-4 rounded">
                    Alle categorieën
                </a>
                @foreach($categories as $category)
                    <a href="/forums/category/{{ $category->id }}" class="{{ request()->is('forums/category/' . $category->id) ? 'border border-gray' : 'bg-main text-darkGreen dark:text-dark dark:bg-main' }}  hover:bg-dark hover:text-main dark:text-main font-bold py-2 px-4 rounded">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

        @foreach($forums as $forum)
        <div class="bg-white dark:bg-gray-100 rounded-lg shadow mb-4">
            <div class="p-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-900">
                        <a href="/forum/{{ $forum->id }}">{{ $forum->title }}</a>
                    </h2>
                    <span class="inline-block bg-main text-blue-800 rounded-full px-3 py-1 text-sm font-semibold">
                        <i class="fas fa-hashtag mr-1"></i>
                        {{ $forum->category->name }}
                    </span>
                </div>
                <p class="text-gray-600 dark:text-gray-500 mb-4">
                    {{ Str::limit($forum->body, 150) }}
                </p>
                <!-- Laatste twee antwoorden van dit forum -->
                <div class="pl-4 border-l-4 border-gray-200">
                    @foreach($forum->replies->take(2) as $reply)
                        <div class="mb-4">
                            <div class="text-sm text-gray-500">
                                <strong>{{ $reply->user->username }}</strong> - <span class="text-gray-400">{{ $reply->created_at->format('d M Y') }}</span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-500">
                                {{ Str::limit($reply->body, 100) }}
                            </p>
                        </div>
                    @endforeach
                </div>
                <div>
                    <a href="/forum/{{ $forum->id }}" class="text-sm text-gray-500 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-500">
                        <i class="fas fa-comments mr-1"></i>
                        Bekijk alle {{ $forum->replies->count() }} reacties
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>
