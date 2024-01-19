<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{$contact->subject}}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="mb-4">
                <h3 class="text-lg font-semibold">Van:</h3>
                <p>{{$contact->first_name}} {{$contact->last_name}} - <span class="text-gray-600">{{$contact->email}}</span></p>
            </div>
            <div class="mb-4">
                <h3 class="text-lg font-semibold">Bericht:</h3>
                <p>{{$contact->message}}</p>
            </div>
            <div class="text-gray-600 mb-4">
                Ontvangen op {{$contact->created_at->format('d-m-Y H:i')}}
            </div>
            <div class="mt-6">
                <h3 class="text-lg font-semibold mb-2">Antwoord:</h3>
                <form>
                    @csrf
                    <textarea name="reply" rows="4" class="w-full rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Schrijf uw antwoord hier..."></textarea>
                    <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Verstuur
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
