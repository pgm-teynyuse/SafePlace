<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Maak een activiteit
        </h2>
    </x-slot>

    <div id="activities" class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <form action="{{ route('activities') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4" enctype="multipart/form-data">

            @csrf
            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Titel</label>
                <input type="text" name="title" id="title" placeholder="Titel" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('title') border-red-500 @enderror" value="{{ old('title') }}">
                @error('title')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-4 md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700">Beschrijving</label>
                <textarea name="description" id="description" placeholder="Beschrijving" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image URL -->
            <div class="mb-4 ">
                <label for="image" class="sr-only">Image</label>
                <input type="file" name="image" id="image" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('image') border-red-500 @enderror">
                @error('image')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Start Date -->
            <div class="mb-4">
                <label for="start_date" class="block text-sm font-medium text-gray-700">Begin datum</label>
                <input type="date" name="start_date" id="start_date" placeholder="Begin datum" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('start_date') border-red-500 @enderror" value="{{ old('start_date') }}">
                @error('start_date')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- End Date -->
            <div class="mb-4">
                <label for="end_date" class="block text-sm font-medium text-gray-700">Eind datum</label>
                <input type="date" name="end_date" id="end_date" placeholder="Eind datum" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('end_date') border-red-500 @enderror" value="{{ old('end_date') }}">
                @error('end_date')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Max Participants -->
            <div class="mb-4">
                <label for="max_participants" class="block text-sm font-medium text-gray-700">Maximum deelnemers</label>
                <input type="number" name="max_participants" id="max_participants" placeholder="Maximum deelnemers" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('max_participants') border-red-500 @enderror" value="{{ old('max_participants') }}">
                @error('max_participants')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Min Participants -->
            <div class="mb-4">
                <label for="min_participants" class="block text-sm font-medium text-gray-700">Minimum deelnemers</label>
                <input type="number" name="min_participants" id="min_participants" placeholder="Minimum deelnemers" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('min_participants') border-red-500 @enderror" value="{{ old('min_participants') }}">
                @error('min_participants')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Location -->
            <div class="mb-4">
                <label for="location" class="block text-sm font-medium text-gray-700">Locatie</label>
                <input type="text" name="location" id="location" placeholder="Locatie" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('location') border-red-500 @enderror" value="{{ old('location') }}">
                @error('location')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="md:col-span-2">
                <button type="submit" class="inline-block transform hover:bg-buttonSecondLight bg-buttonSecond text-purple-600 rounded px-4 py-2 hover:bg-purple-200 transition duration-300 w-full">Publiceer</button>
            </div>
        </form>
    </div>
</x-app-layout>
