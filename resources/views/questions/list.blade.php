<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="font-bold text-3xl text-gray-900 dark:text-white leading-tight">
                FAQ
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @foreach($questions as $question)
            <div x-data="{ open: false }" class="bg-buttonLight mb-2 dark:bg-gray-800 overflow-hidden shadow-darkGreen border-2 border-darkGreen rounded-lg p-6 hover:shadow-xl transition-shadow duration-300 ease-in-out">
                <h2 @click="open = !open" class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 cursor-pointer flex justify-between items-center">
                    {{ $question->question }}
                    <i :class="{'fa-chevron-up': open, 'fa-chevron-down': !open}" class="fas"></i>
                </h2>
                <div x-show="open" class="text-gray-600 dark:text-gray-400">
                    {{$question->answer}}
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
