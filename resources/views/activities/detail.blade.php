<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $activity->name }}
        </h2>
            <div class="mt-4">
<form action="{{ route('activity.participate.store') }}" method="post">
    @csrf
    <input type="hidden" name="activity_id" value="{{ $activity->id }}">
    <label for="first_name">Voornaam:</label>
    <input type="text" name="first_name" required>
    <label for="last_name">Achternaam:</label>
    <input type="text" name="last_name" required>
    <label for="email">E-mail:</label>
    <input type="email" name="email" required>
    <label for="phone">Telefoon:</label>
    <input type="text" name="phone" required>
    <button type="submit">Deelnemen</button>
</form>

    </div>
    </x-slot>

    <div id="activity" class=" mx-auto py-6 px-4 sm:px-6 lg:px-8  grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <p class="text-gray-600">{{ $activity->description }}</p>
                    <p class="text-gray-600">Location: {{ $activity->location }}</p>
                    <p class="text-gray-600">Start Date: {{ $activity->start_date }}</p>
                    <p class="text-gray-600">End Date: {{ $activity->end_date }}</p>
                    <p class="text-gray-600">User: {{ $activity->user->username }}</p>
                </div>
            </div>
    </div>
    

</x-app-layout>






