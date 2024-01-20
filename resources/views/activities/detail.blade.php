<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-900 dark:text-white leading-tight">
            {{ $activity->title }}
        </h2>

        @if (Auth::check() && Auth::user()->id == $activity->user_id)
        <div class="flex items-center justify-between mt-2">
            <a href="/activity/{{ $activity->id }}/edit" class="mr-4 transform hover:bg-buttonSecondLight border-buttonSecond border-solid border-2 text-primary rounded-lg px-4 py-2 hover:bg-purple-200 transition duration-300">
                <i class="fas fa-edit"></i>
                Bewerk
            </a>
            <form action="/activities/{{ $activity->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="transform hover:bg-redLight border-red border-solid border-2 text-redDark rounded-lg px-4 py-2 hover:bg-purple-200 transition duration-300">
                    <i class="fas fa-trash-alt"></i>
                    Verwijder
                </button>
            </form>
        </div>
        @endif
    </x-slot>

    <div class="container mx-auto p-6">
        <div class="flex flex-wrap -mx-4">
            @if(auth()->guest() || auth()->user()->id !== $activity->user_id)
            <div class="w-full lg:w-1/2 px-4">
                <div class="bg-white overflow-hidden shadow-lg rounded-lg mb-6 p-6">
                    <div class="mb-6">
                        <img src="{{ asset('storage/' . $activity->image) }}" alt="{{ $activity->title }}" class="w-full h-64 object-cover rounded-lg">
                    </div>
                    <h3 class="text-3xl font-semibold mb-4">{{ $activity->title }}</h3>
                    <p class="text-gray-700 mb-4">{{ $activity->description }}</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-600 font-semibold">Locatie:</p>
                            <p class="text-gray-600">{{ $activity->location }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-semibold">Begin:</p>
                            <p class="text-gray-600">{{ \Carbon\Carbon::parse($activity->start_date)->format('d M, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-semibold">Eind:</p>
                            <p class="text-gray-600">{{ \Carbon\Carbon::parse($activity->end_date)->format('d M, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-semibold">Organisator:</p>
                            <p class="text-gray-600">{{ $activity->user->username }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl lg:w-1/2 px-4">
                <div class="bg-white overflow-hidden shadow-lg rounded-lg mb-6 p-6">
                    <h3 class="text-3xl font-semibold mb-4">Wil je deelnemen?</h3>
                    <p>Je hoeft geen account te hebben om deel te nemen. Wij contacteren u wel.</p>
                    <form class="" action="{{ route('activity.participate.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="activity_id" value="{{ $activity->id }}">

                        <div class="mb-4">
                            <label for="first_name" class="block text-gray-700 font-semibold">Voornaam:</label>
                            <input type="text" name="first_name" required class="input-field w-full">
                        </div>

                        <div class="mb-4">
                            <label for="last_name" class="block text-gray-700 font-semibold">Achternaam:</label>
                            <input type="text" name="last_name" required class="input-field w-full">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-semibold">E-mail:</label>
                            <input type="email" name="email" required class="input-field w-full">
                        </div>

                        <div class=" mb-14">
                            <label for="phone" class="block text-gray-700 font-semibold">Telefoon:</label>
                            <input type="text" name="phone" required class="input-field w-full">
                        </div>

            <div>
                <button type="submit" class="w-full transform hover:bg-buttonSecondLight bg-buttonSecond text-purple-600 rounded px-4 py-2 hover:bg-purple-200 transition duration-300">Deelnemen</button>
            </div>
                    </form>
                </div>
            </div>
            @else
                        <div class="w-full lg:w-1/1 px-4">
                <div class="bg-white overflow-hidden shadow-lg rounded-lg mb-6 p-6">
                    <div class="mb-6">
                        <img src="{{ asset('storage/' . $activity->image) }}" alt="{{ $activity->title }}" class="w-full h-64 object-cover rounded-lg">
                    </div>
                    <h3 class="text-3xl font-semibold mb-4">{{ $activity->title }}</h3>
                    <p class="text-gray-700 mb-4">{{ $activity->description }}</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-600 font-semibold">Locatie:</p>
                            <p class="text-gray-600">{{ $activity->location }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-semibold">Begin:</p>
                            <p class="text-gray-600">{{ \Carbon\Carbon::parse($activity->start_date)->format('d M, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-semibold">Eind:</p>
                            <p class="text-gray-600">{{ \Carbon\Carbon::parse($activity->end_date)->format('d M, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-semibold">Organisator:</p>
                            <p class="text-gray-600">{{ $activity->user->username }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
