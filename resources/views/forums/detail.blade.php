<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $forum->title }}
        </h2>
    </x-slot>

<div class="flex ">
<div class="w-3/4">
    <div class="max-w-7xl  mx-auto sm:px-6 lg:px-8 py-6">
        <div class=" p-4">
            <div class="bg-main border dark:text-dark border-darkGreen dark:bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold mb-2">{{ $forum->title }}</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">{{ $forum->body }}</p>
                
                <div class="flex flex-row space-x-4 text-sm text-gray-500 dark:text-gray-300">
                    <div class="flex items-center">
                        <i class="fas fa-user mr-2"></i>
                        <span>{{ $forum->user->username }}</span>
                    </div>
                    
                    <div class="flex items-center">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        <span>{{ $forum->created_at->format('d M Y') }}</span>
                    </div>

                    <div class="flex items-center">
                        <i class="fas fa-comments mr-2"></i>
                        <span>{{ $forum->replies->count() }} reacties</span>
                    </div>

                    <div class="flex items-center">
                        <i class="fas fa-hashtag mr-2"></i>
                        <span>{{ $forum->category->name }}</span>
                    </div>
                </div>
            </div>
        <div>
            <form action="{{ route('answer', $forum->id) }}" method="POST" class="mb-5 grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf
                <div class="mb-4 md:col-span-2">
                    <label for="body" class="block text-sm mb-2 font-medium dark:text-white text-darkGreen">Voeg een ractie toe:</label>
                    <textarea name="body" id="body" placeholder="Begin hier te typen..." class="dark:bg-gray placeholder-darkGreen dark:placeholder-white border border-darkGreen w-full p-4 rounded-lg @error('body') border-red-500 @enderror">{{ old('body') }}</textarea>
                    @error('body')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <input type="hidden" name="forum_id" value="{{ $forum->id }}">
                <div class="md:col-span-2">
                    <button type="submit" class="inline-block transform hover:bg-main border-darkGreen border text-purple-600 rounded dark:text-white px-4 py-2 hover:bg-purple-200 transition duration-300 w-full">Publiceer</button>
                </div>
            </form>
        </div>
        </div>
        <div class=" dark:bg-white overflow-hidden p-6">
        @foreach ($replies as $answer)
            <div class="mb-4 border-b border-darkGreen pb-4">
                <p class="text-gray-600 dark:text-gray-400">{{ $answer->body }}</p>
                <div class="text-sm text-gray-500 dark:text-gray-300 mt-2">
                    <i class="fas fa-user"></i>
                    {{ $answer->user->username }} op {{ $answer->created_at->format('d M Y') }}
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>
        <div class=" w-2/6 mt-5 p-4 border-darkGreen border-l ">
            <h3 class="font-semibold dark:text-white text-lg mb-4">Gerelateerde Blogs</h3>
            @foreach ($relatedBlogs as $blog)
            <a class=" " href="/blog/{{$blog->id}}">
                <div class="mb-3 dark:bg-gray rounded-lg p-4 shadow">
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="w-full h-48 object-cover rounded-t-lg">
                    <h4 class="font-semibold">{{ $blog->title }}</h4>
                    <p>{{ Str::limit($blog->body, 100) }}</p>
                </div>
            </a>
            @endforeach
        </div>
</div>
</x-app-layout>
