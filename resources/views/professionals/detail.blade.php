<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $professional->first_name }} {{ $professional->last_name }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mt-4 mx-auto py-6 px-4 sm:px-6 lg:px-8 bg-white rounded-lg shadow-lg">
        <div class="flex flex-col md:flex-row">
            <div class="md:w-1/3">
                <img src="{{ asset('storage/' . $professional->avatar) }}" alt="{{ $professional->first_name }} {{ $professional->last_name }}" class="rounded-lg w-full h-auto object-cover">
            </div>
            <div class="md:w-2/3 md:pl-6">
                <h3 class="text-2xl text-purple-600 dark:text-purple-300 font-semibold mb-4">{{ $professional->first_name }} {{ $professional->last_name }}</h3>
                <p class="text-gray-700 text-opacity-80 mb-4"><i class="fas fa-graduation-cap"></i> {{ $professional->branch }}</p>
                <p class="text-gray-700 mb-6">{{ $professional->bio }}</p>
                <a href="/professionals/contact/{{ $professional->id }}" class="inline-block transform hover:bg-buttonLight bg-button text-purple-600 rounded px-4 py-2 hover:bg-purple-200 transition duration-300">
                    <i class="fas fa-envelope"></i> Contacteer
                </a>
            </div>
        </div>
    </div>       
</x-app-layout>
