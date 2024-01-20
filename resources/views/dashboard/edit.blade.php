<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div class="flex-1">{{ __('Bewerk forum') }}</div>
            <div class="flex-1 ml-4">@include('layouts.dashboard-navigation')</div>
        </div>
    </x-slot>

<div class="py-12">
    <div class="container mx-auto px-4">
        <form action="{{ route('update.dashboard', $forum->id) }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Titel</label>
                <input type="text" id="title" name="title" value="{{ $forum->title }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div class="mb-4">
                <label for="body" class="block text-sm font-medium text-gray-700">Inhoud</label>
                <textarea id="body" name="body" rows="4" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ $forum->body }}</textarea>
            </div>
            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700">Categorie</label>
                <select id="category" name="category_id" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $forum->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-between">
            <button type="submit" class="w-full transform hover:bg-buttonSecondLight bg-buttonSecond text-purple-600 rounded px-4 py-2 hover:bg-purple-200 transition duration-300">Bewaar Wijzigingen</button>
            <button type="button" onclick="window.location='{{ url()->previous() }}'" class="w-full transform hover:bg-buttonSecondLight bg-red text-purple-600 rounded px-4 py-2 hover:bg-purple-200 transition duration-300">Annuleer</button>
        </div>
        </form>
    </div>
</div>

    
</x-app-layout>