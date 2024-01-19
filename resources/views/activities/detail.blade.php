<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-900 dark:text-white leading-tight">
            {{ $activity->title }}
        </h2>

        @if (Auth::check() && Auth::user()->id == $activity->user_id) 
        <div class="flex align-middle justify-between">
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

    <div class="z-40 mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Activity Details -->
        <div class="overflow-hidden rounded-lg mb-8">
            <div class="p-6">
                <p class="text-gray-700 mb-4">{{ $activity->description }}</p>
                <p class="text-gray-600 mb-2">Location: {{ $activity->location }}</p>
                <p class="text-gray-600 mb-2">Begin: {{ \Carbon\Carbon::parse($activity->start_date)->format('d M, Y') }}</p>
                <p class="text-gray-600 mb-2">Eind: {{ \Carbon\Carbon::parse($activity->end_date)->format('d M, Y') }}</p>
                <p class="text-gray-600">Organisator: {{ $activity->user->username }}</p>
            </div>
        </div>
        @if($activity->user_id !== auth()->user()->id)
        <!-- Participation Form -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-6">
                <h3 class="text-2xl font-semibold mb-4">Wil je deelnemen?</h3>
                <form action="{{ route('activity.participate.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                    
                    <div class="mb-4">
                        <label for="first_name" class="block text-sm font-medium text-gray-700">Voornaam:</label>
                        <input type="text" name="first_name" required class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Achternaam:</label>
                        <input type="text" name="last_name" required class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">E-mail:</label>
                        <input type="email" name="email" required class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Telefoon:</label>
                        <input type="text" name="phone" required class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <button type="submit" class="w-full transform hover:bg-buttonSecondLight bg-buttonSecond text-purple-600 rounded px-4 py-2 hover:bg-purple-200 transition duration-300">
                        Deelnemen
                    </button>
                </form>
            </div>
        </div>
        @endif
    </div>
</x-app-layout>
