<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
    a{
        text-decoration: none;
    }
    .navbar{
        justify-content: space-around;
    }
</style>

<div class="navbar">
    <x-nav-link :href="route('Home')" :active="request()->routeIs('Home')">
        {{ __('Home') }}
    </x-nav-link>
    <x-nav-link :href="route('sell.parts')" :active="request()->routeIs('sell.parts')">
        {{ __('Order Parts') }}
    </x-nav-link>
    <x-nav-link :href="route('schedule.maintenance')" :active="request()->routeIs('schedule.maintenance')">
        {{ __('Schedule Maintenance') }}
    </x-nav-link>

    <x-nav-link :href="route('ratings.create')" :active="request()->routeIs('ratings.create')">
        {{ __('Employees Ratings') }}
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
    {{-- Checks if Any employee is currently logged in --}}
    @if(Auth::user() !== null && !Auth::user()->isCustomer())
        <x-nav-link :href="route('schedule.view')" :active="request()->routeIs('schedule.view')">
            {{ __('View Schedule') }}
        </x-nav-link>
    @endif

    {{-- Checks if current user is a customer --}}
    @if(Auth::user() !== null && Auth::user()->isCustomer())
        <x-nav-link :href="route('ratings.create')" :active="request()->routeIs('ratings.create')">
            {{ __('Rate an Employee') }}
        </x-nav-link>
    @endif

    {{-- Checks if the current user is not logged in --}}
    @if (Auth::user() === null)
        <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
            {{ __('Register') }}
        </x-nav-link>
        <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
            {{ __('Login') }}
        </x-nav-link>
    @else
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-nav-link>
    @endif
</div>
