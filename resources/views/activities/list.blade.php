<x-app-layout>
<x-slot name="header">
    <div class="flex justify-between items-center w-full">
        <!-- Title -->
        <h2 class="font-bold text-3xl text-gray-900 dark:text-white leading-tight">
            Activiteiten
        </h2>
        @if (Auth::check() && Auth::user()->role_id == 1)
            <a href="/activities/create" class="transform hover:bg-buttonSecondLight border-darkGreen border-solid border-2 text-darkGreen rounded-lg px-4 py-2 hover:bg-main transition duration-300">
                <i class="fas fa-plus"></i>
                Nieuwe activiteit
            </a>
        @endif
    </div>
</x-slot>



    <div id="activities" class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
        @foreach($activities as $activity)
            <div class="bg-white hover:bg-gray-50 transition duration-300 ease-in-out border border-gray-200 rounded-lg overflow-hidden shadow-md">
                <img src="{{ $activity->image_url }}" alt="{{ $activity->title }}" class="w-full h-56 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">
                        <a href="/activity/{{ $activity->id }}" class="hover:underline">{{ $activity->title }}</a>
                    </h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($activity->description, 100) }}</p>
                    <div class="text-sm text-gray-500 mb-4">
                        <p>Locatie: {{ $activity->location }}</p>
                        <p>Van {{ \Carbon\Carbon::parse($activity->start_date)->format('d M, Y') }} tot {{ \Carbon\Carbon::parse($activity->end_date)->format('d M, Y') }}</p>
                    </div>
                    <div class="mt-4 text-gray-500 dark:text-gray-300">
                    <i class="fas fa-user"></i>
                    {{ $activity->user->username }}
                    </div>
                    <a href="/activity/{{ $activity->id }}" class="mt-4 inline-block transform hover:bg-buttonSecondLight bg-buttonSecond text-purple-600 rounded px-4 py-2 hover:bg-purple-200 transition duration-300">
                        Meer Info
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
