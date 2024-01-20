<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $blog->title }}
        </h2>
        @if (Auth::check() && Auth::user()->id == $blog->user_id) 
        <div class="flex justify-between">
            <a href="/blog/{{ $blog->id }}/edit" class="mr-4 transform hover:bg-buttonSecondLight border-buttonSecond border-solid border-2 text-primary rounded-lg px-4 py-2 hover:bg-purple-200 transition duration-300">
                <i class="fas fa-edit"></i>
                Bewerk
            </a>
            <form action="/blogs/{{ $blog->id }}" method="POST">
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

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="bg-cover bg-center h-64 p-4" style="background-image: url('{{ asset('storage/' . $blog->image) }}')">
            </div>
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Auteur: {{ $blog->user->username }}
                </h3>
                <p class="mt-1 mb-4 max-w-2xl text-sm text-gray-500">
                    Gepubliceerd op: {{ $blog->created_at->format('M d, Y') }}
                </p>
                    <span class="bg-main text-black dark:bg-main rounded-full  px-3 py-1 text-sm font-semibold">
                            <i class="fas fa-hashtag"></i>
                            {{ $blog->category->name }}
</span>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Blog Content
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $blog->body }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-app-layout>
