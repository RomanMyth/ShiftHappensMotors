<style>
    a{
        text-decoration: none;
    }
</style>

<div class="navbar">
    <x-nav-link :href="route('Home')" :active="request()->routeIs('Home')">
        {{ __('Home') }}
    </x-nav-link>
    <x-nav-link :href="route('sell.parts')" :active="request()->routeIs('sell.parts')">
        {{ __('Parts') }}
    </x-nav-link>
    <x-nav-link :href="route('schedule.maintenance')" :active="request()->routeIs('schedule.maintenance')">
        {{ __('Schedule Maintenance') }}
    </x-nav-link>

    {{-- Check if any user is currently logged in and if that user is a Manager--}}
    @if (Auth::user() !== null && Auth::user()->isAdmin())
        <x-nav-link :href="route('employees.create')" :active="request()->routeIs('employees.create')">
            {{ __('Add Employees') }}
        </x-nav-link>
        <x-nav-link :href="route('Vehicle.create')" :active="request()->routeIs('Vehicle.create')">
            {{ __('Add Vehicle') }}
        </x-nav-link>
        <x-nav-link :href="route('Part.create')" :active="request()->routeIs('Part.create')">
            {{ __('Add Part') }}
        </x-nav-link>
        <x-nav-link :href="route('schedule')" :active="request()->routeIs('schedule')">
            {{ __('Create Schedule') }}
        </x-nav-link>
    @endif

    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>
</div>