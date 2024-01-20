<div x-data="{ open: false }" >
    <div class="flex align-middle max-w-7xl mx-auto">
        <div>
            @if (Auth::check() && Auth::user()->role_id == 1)    
            <x-nav-link :href="route('activities.dashboard')" class="w-40" :active="request()->routeIs('activities.dashboard')">
                {{ __('Activiteit verzoeken') }}
            </x-nav-link>
            @endif
        </div>
        <div>
            <x-nav-link :href="route('forums.dashboard')" class="w-40" :active="request()->routeIs('forums.dashboard')">
                {{ __('Beheer Forums') }}
            </x-nav-link>
        </div>
    </div>
</div>
