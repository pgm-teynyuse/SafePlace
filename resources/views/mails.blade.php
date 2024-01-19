<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mails') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <table class="min-w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Verzender</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Onderwerp</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Datum</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($contacts as $contact)
                    @if($contact->professional_id == auth()->user()->id)
                                <tr class="hover:bg-buttonLight dark:hover:bg-gray-700 cursor-pointer" onclick="window.location='/mail/{{$contact->id}}'">
                                    
                                    <td class="flex px-6 py-4 whitespace-nowrap">
                                        <i class="fas fa-envelope mr-4  text-main dark:text-gray-200"></i>
                                        <div class="text-sm text-gray-900 dark:text-gray-200">{{$contact->first_name}} {{$contact->last_name}}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-200">{{ $contact->subject }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-200">{{ $contact->created_at->format('d/m/Y') }}</div>
                                    </td>
                                </tr>
                                @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
