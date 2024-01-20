<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Bewerk blog
        </h2>
    </x-slot>

    <div id="blogs" class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <form method="POST">
        @csrf
        @method('PATCH')
            <div class="mb-4">
                <label for="title" class="sr-only">Title</label>
                <input type="text" name="title" id="title" placeholder="Title" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('title') border-red-500 @enderror" value="{{ $blog->title }}">

                @error('title')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror

            </div>
                        <div class="mb-4">
                <label for="category_id" class="sr-only">Categorie</label>
                <select name="category_id" id="category_id" class="bg-gray-100 border-2 w-full p-4 rounded-lg">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $blog->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="body" class="sr-only">Body</label>
                <textarea name="body" id="body" cols="30" rows="4" placeholder="Body" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror">{{ $blog->body }}</textarea>

                @error('body')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
    </div>
            <div>
                <button type="submit" class="w-full transform hover:bg-buttonSecondLight bg-buttonSecond text-purple-600 rounded px-4 py-2 hover:bg-purple-200 transition duration-300">Bewerk</button>
            </div>
    </form>
</x-app-layout>





