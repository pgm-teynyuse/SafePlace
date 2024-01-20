<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div class="flex-1">{{ __('Mijn Forums') }}</div>
            <div class="flex-1 ml-4">@include('layouts.dashboard-navigation')</div>
        </div>
    </x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @if ($forums->count())
                    <div class="mt-4">
                        @foreach ($forums as $forum)
                            <div class="mb-6 p-4 bg-gray-100 rounded-lg shadow-sm">
                                <h3 class="text-xl font-semibold text-gray-700 mb-2">{{ $forum->title }}</h3>
                                <p class="text-gray-600 mb-4">{{ Str::limit($forum->body, 100) }}</p>
<div class="flex space-x-4">
    <a href="{{ route('forums.detail', $forum->id) }}" class="bg-darkGreen hover:bg-dark text-white rounded-md px-4 py-2">Bekijk Forum</a>
    <a href="{{ route('dashboard.forums.edit', $forum->id) }}" class="bg-buttonSecond hover:bg-buttonSecondLight text-white rounded-md px-4 py-2">Bewerk</a>
    <form action="{{ route('dashboard.forums.delete', $forum->id) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red hover:bg-redLight text-white rounded-md px-4 py-2">Verwijder</button>
    </form>
</div>


                            </div>
                        @endforeach
                        <div class="mt-6">
                            {{ $forums->links() }}
                        </div>
                    </div>
                @else
                <div>
                <p class="text-gray-600 mb-4">Je hebt nog geen forums aangemaakt.</p>
                <a href="/forums/create" class="transform hover:bg-buttonSecondLight  border-darkGreen border-solid border-2 text-darkGreen rounded-lg px-4 py-2 hover:bg-main transition duration-300">
                    <i class="fas fa-plus mr-2"></i> Maak een forum aan
                </a>
            </div>
                @endif
            </div>
        </div>
    </div>
</div>


    
</x-app-layout>
