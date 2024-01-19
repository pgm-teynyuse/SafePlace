<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Contact
        </h2>
    </x-slot>

 <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-6">
                <form action="{{ route('professionals.contact.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="professional_id" value="{{ $professionalId }}">
                    
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
                        <label for="subject" class="block text-sm font-medium text-gray-700">Onderwerp:</label>
                        <input type="text" name="subject" required class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="mb-4">
                        <label for="message" class="block text-sm font-medium text-gray-700">Bericht:</label>
                        <textarea type="text" name="message" required class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>
                    <button type="submit" class="w-full transform hover:bg-buttonSecondLight bg-buttonSecond text-purple-600 rounded px-4 py-2 hover:bg-purple-200 transition duration-300">
                        Verzenden
                    </button>
                </form>
            </div>
        </div>
</x-app-layout>