<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Activities
        </h2>
    </x-slot>

    <div id="activities" class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach($activities as $activity)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-lg font-semibold mb-2">
                        <a href="/activity/{{ $activity->id }}">{{ $activity->title }}</a>
                    </h2>
                    <p class="text-gray-600">{{ $activity->description }}</p>
                    <p class="text-gray-600">Location: {{ $activity->location }}</p>
                    <p class="text-gray-600">Start Date: {{ $activity->start_date }}</p>
                    <p class="text-gray-600">End Date: {{ $activity->end_date }}</p>
                    <p class="text-gray-600">User: {{ $activity->user->username }}</p>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
