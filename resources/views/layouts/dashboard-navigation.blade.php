<div x-data="{ open: false }" >
    <div class="flex align-middle max-w-7xl mx-auto">
        <div>
            <x-nav-link :href="route('activities.dashboard')" class="w-40" :active="request()->routeIs('activities.dashboard')">
                {{ __('Activiteit verzoeken') }}
            </x-nav-link>
        </div>
        <div>
            <x-nav-link :href="route('dashboard')" class="w-40" :active="request()->routeIs('dashboard')">
                {{ __('Beheer Forums') }}
            </x-nav-link>
        </div>
    </div>
</div>
