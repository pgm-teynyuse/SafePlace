<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div class="flex-1">{{ __('Deelnameverzoeken') }}</div>
            <div class="flex-1 ml-4">@include('layouts.dashboard-navigation')</div>
        </div>
    </x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg p-6">
            @foreach($participants as $participant)
                @if($participant->activity->user_id == auth()->user()->id)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden mb-4 shadow-sm sm:rounded-lg p-4">
                        <div class="mb-6">
                            <h3 class="text-2xl font-semibold mb-2">{{ $participant->activity->title }}</h3>
                            <div class="text-lg text-gray-700 dark:text-gray-300">
                                <strong>Verzoeker:</strong> {{ $participant->first_name }} {{ $participant->last_name }}
                            </div>
                        </div>
                        <div class="mb-6">
                            <p>Email: {{ $participant->email }}</p>
                            <p>Telefoon: {{ $participant->phone }}</p>
                            <p>Aangemaakt op: {{ $participant->created_at->format('d-m-Y H:i') }}</p>
                        </div>
                        <div class="flex space-x-4">
                                @if($participant->confirmed == 1)
                                    <span class="text-primary rounded-lg px-4 py-2">
                                        Bevestigd
                                    </span>
                            <form action="/cancel/{{$participant->id}}" method="GET">
                                <button class="transform hover:bg-redLight border-red border-solid border-2 text-redDark rounded-lg px-4 py-2 hover:bg-purple-200 transition duration-300">
                                    Annuleren
                                </button>
                            </form>
                                @else
                                    <form action="/confirm/{{$participant->id}}" method="GET">
                                        <button type="submit" class="mr-4 transform hover:bg-buttonSecondLight border-buttonSecond border-solid border-2 text-primary rounded-lg px-4 py-2 hover:bg-purple-200 transition duration-300">
                                            Bevestigen
                                        </button>
                                    </form>
                                    <form action="/delete/{{$participant->id}}" method="GET">
                                        <button class="transform hover:bg-redLight border-red border-solid border-2 text-redDark rounded-lg px-4 py-2 hover:bg-purple-200 transition duration-300">
                                            Verwijderen
                                        </button>
                                    </form>
                                @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

</x-app-layout>
