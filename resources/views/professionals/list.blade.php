<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-purple-600 dark:text-purple-300 leading-tight text-center">
            Onze Professionals
        </h2>
    </x-slot>

    <div id="professionals" class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
        @foreach($professionals as $prof)
            <div class=" w-18 rounded-xl shadow-lg overflow-hidden">
                <img src="{{ $prof->avatar }}" alt="{{ $prof->first_name }} {{ $prof->last_name }}" class="w-full h-56 object-cover">
                <div class="p-2">
                    <h3 class="text-xl text-white font-semibold mb-2">{{ $prof->first_name }} {{ $prof->last_name }}</h3>
                    <p class="text-white text-opacity-80 mb-5"><i class="fas fa-graduation-cap"></i> {{ $prof->branch }}</p>
                    <p class=" text-gray mb5">{{ Str::limit($prof->bio, 100) }}</p>
                    <div>
                    <a href="/professionals/contact/{{ $prof->id }}" class="mt-4 inline-block transform hover:bg-buttonLight bg-button text-purple-600 rounded px-4 py-2 hover:bg-purple-200 transition duration-300">
                    <i class="fas fa-envelope"></i>      
                    Contacteer
                    </a>
                    <a href="/professional/{{ $prof->id }}" class="mt-4 inline-block transform hover:bg-buttonSecondLight bg-buttonSecond text-purple-600 rounded px-4 py-2 hover:bg-purple-200 transition duration-300">  
                    Meer info
                    </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>


