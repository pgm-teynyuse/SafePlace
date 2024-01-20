<x-app-layout>
    <x-slot name="header">
        <div class=" flex flex-col ">
        <h2 class="font-semibold mb-4 text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Maak een blog
        </h2>
    <div class=" dark:text-white">
        <p>
            <i class="fa-solid fa-triangle-exclamation"></i>
            Laten we samenwerken om een vriendelijke en respectvolle gemeenschap te behouden. Wees voorzichtig met je woorden en zorg ervoor dat we anderen niet onbedoeld kwetsen. Samen kunnen we een positieve online omgeving creëren waar iedereen zich welkom voelt. Dank je wel!</p>
    </div> 
        </div>

    </x-slot>

    <div id="blogs" class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">


        <form action="{{ route('blogs') }}" method="POST" enctype="multipart/form-data"> 
            @csrf
            <div class="mb-4">
                <label for="title" class="dark:text-white">Titel</label>
                <input type="text" name="title" id="title" placeholder="Title" class="dark:bg-gray border-2 w-full p-4 rounded-lg @error('title') border-red-500 @enderror" value="{{ old('title') }}">
                @error('title')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-4 md:col-span-2">
                <label for="category_id" class="dark:text-white">Categorie</label>
                <select name="category_id" id="category_id" class="dark:bg-gray border-2 w-full p-4 rounded-lg @error('category_id') border-red-500 @enderror">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="body" class="dark:text-white">Jouw tekst</label>
                <textarea name="body" id="body" cols="30" rows="4" placeholder="Body" class="dark:bg-gray border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror">{{ old('body') }}</textarea>

                @error('body')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="image" class="dark:text-white">Selecteer een afbeelding</label>
                <input type="file" name="image" id="image" class="dark:bg-gray border-2 w-full p-4 rounded-lg @error('image') border-red-500 @enderror">
                @error('image')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="md:col-span-2">
                <button type="submit" class="inline-block transform hover:bg-buttonSecondLight bg-buttonSecond text-purple-600 rounded px-4 py-2 hover:bg-purple-200 transition duration-300 w-full">Publiceer</button>
            </div>
        </form>
    </div>
</x-app-layout>
