
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Create blog
        </h2>
    </x-slot>

    <div id="blogs" class=" max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8  grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        <form action="{{ route('blogs') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="sr-only">Title</label>
                <input type="text" name="title" id="title" placeholder="Title" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('title') border-red-500 @enderror" value="{{ old('title') }}">

                @error('title')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror

            </div>
            <div class="mb-4">
                <label for="body" class="sr-only">Body</label>
                <textarea name="body" id="body" cols="30" rows="4" placeholder="Body" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror">{{ old('body') }}</textarea>

                @error('body')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror


            </div>
            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Create</button>
            </div>
        </form>
    </div>
</x-app-layout>





