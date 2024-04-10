<!-- Navbar.blade.php -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
    a {
        text-decoration: none;
    }

    .navbar {
        justify-content: space-between;
        position: relative;
        padding-left: 20px;
        transition: padding-left 0.3s ease, background-color 0.3s ease;
        background-color: transparent;
    }

    .toggle-navbar {
        background: none;
        border: none;
        cursor: pointer;
        padding: 5px;
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 999;
    }

    .hamburger-icon {
        width: 35px;
        height: 10px;
        background-color: #333;
        display: block;
        position: relative;
    }

    .hamburger-icon:before,
    .hamburger-icon:after {
        content: '';
        background-color: #333;
        display: block;
        position: absolute;
        width: 100%;
        height: 100%;
        transition: transform 0.3s ease;
    }

    .hamburger-icon:before {
        top: -10px;
    }

    .hamburger-icon:after {
        bottom: -10px;
    }

    .navbar.show {
        background-color: #f8f9fa;
    }

    .navbar.show #navbarContent {
        background-color: #f8f9fa;
    }

    /* Added styles for transition */
    #navbarContent {
        transition: max-height 0.3s ease;
        max-height: 0;
        overflow: hidden;
    }

    #navbarContent.show {
        max-height: 500px;
    }

    /* New styles for hover effects */
    .navbar-link {
        position: relative;
      font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
      color: #292626ab
    }

    .navbar-link::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -3px; /* Adjust the thickness of the line */
        width: 100%;
        height: 2px; /* Adjust the height of the line */
        background-color: transparent; /* Initial color of the line */
        transition: background-color 0.3s ease; /* Add transition effect */

    }

    .navbar-link:hover::after {
        background-color: #3a0cf3; /* Change color of the line on hover */
    }
   
</style>

<!-- Button to toggle navbar -->


<!-- Collapsible navbar content -->
<div class="navbar" id="navbar">
    <!-- Button to toggle navbar -->
    <button id="toggleButton" class="toggle-navbar btn btn-primary" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</div>

<div id="navbarContent" class="navbar collapse">
    <x-nav-link :href="route('Home')" :active="request()->routeIs('+Home')" class="navbar-link">
        {{ __('Home') }}
    </x-nav-link>
    {{-- Check if any user is currently logged in and if that user is a Manager--}}
    @if (Auth::user() !== null && Auth::user()->isAdmin())
        <x-nav-link :href="route('employees.create')" :active="request()->routeIs('employees.create')" class="navbar-link">
            {{ __('Add Employees') }}
        </x-nav-link>
        <x-nav-link :href="route('Vehicle.create')" :active="request()->routeIs('Vehicle.create')" class="navbar-link">
            {{ __('Add Vehicle') }}
        </x-nav-link>
        <x-nav-link :href="route('Part.create')" :active="request()->routeIs('Part.create')" class="navbar-link">
            {{ __('Add Part') }}
        </x-nav-link>
        <x-nav-link :href="route('schedule')" :active="request()->routeIs('schedule')" class="navbar-link">
            {{ __('Create Schedule') }}
        </x-nav-link>
    @endif
    {{-- Checks if Any employee is currently logged in --}}
    @if(Auth::user() !== null && !Auth::user()->isCustomer())
        <x-nav-link :href="route('schedule.view')" :active="request()->routeIs('schedule.view')" class="navbar-link">
            {{ __('View Schedule') }}
        </x-nav-link>
    @endif

    {{-- Checks if current user is a customer --}}
    @if(Auth::user() !== null && Auth::user()->isCustomer())
        <x-nav-link :href="route('ratings.create')" :active="request()->routeIs('ratings.create')" class="navbar-link">
            {{ __('Rate an Employee') }}
        </x-nav-link>
        <x-nav-link :href="route('sell.parts')" :active="request()->routeIs('sell.parts')">
            {{ __('Order Parts') }}
        </x-nav-link>
        <x-nav-link :href="route('schedule.maintenance')" :active="request()->routeIs('schedule.maintenance')">
            {{ __('Schedule Maintenance') }}
        </x-nav-link>
        <x-nav-link :href="route('payment.form')" :active="request()->routeIs('payment.form')">
            {{ __('Make a Payment') }}
        </x-nav-link>
    @endif

    {{-- Checks if the current user is not logged in --}}
    @if (Auth::user() === null)
        <x-nav-link :href="route('sell.parts')" :active="request()->routeIs('sell.parts')">
            {{ __('Order Parts') }}
        </x-nav-link>
        <x-nav-link :href="route('schedule.maintenance')" :active="request()->routeIs('schedule.maintenance')">
            {{ __('Schedule Maintenance') }}
        </x-nav-link>
        <x-nav-link :href="route('ratings.create')" :active="request()->routeIs('ratings.create')">
            {{ __('Rate an Employee') }}
        </x-nav-link>
        <x-nav-link :href="route('register')" :active="request()->routeIs('register')" class="navbar-link">
            {{ __('Register') }}
        </x-nav-link>
        <x-nav-link :href="route('login')" :active="request()->routeIs('login')" class="navbar-link">
            {{ __('Login') }}
        </x-nav-link>
    @else
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="navbar-link">
            {{ __('Dashboard') }}
        </x-nav-link>
    @endif

    <!-- Close button to hide the navbar -->
    <button class="close-btn" onclick="hideNavbar()">X</button>
</div>



<script>
    // Function to toggle the visibility of the navbar
    function toggleNavbar() {
        var navbarContent = document.getElementById('navbarContent');
        var toggleButton = document.getElementById('toggleButton');
        var navbar = document.getElementById('navbar');
        if (navbarContent.classList.contains('show')) {
            navbarContent.classList.remove('show');
            toggleButton.style.display = 'block'; // Show the toggle button
            navbar.style.paddingLeft = '0'; // Remove left padding
            navbar.style.backgroundColor = 'transparent'; // Reset navbar background color
        } else {
            navbarContent.classList.add('show');
            toggleButton.style.display = 'none'; // Hide the toggle button
            navbar.style.paddingLeft = '20px'; // Add left padding
            navbar.style.backgroundColor = '#f8f9fa'; // Change navbar background color
        }
    }

    // Function to hide the navbar when close button is clicked
    function hideNavbar() {
        var navbarContent = document.getElementById('navbarContent');
        var toggleButton = document.getElementById('toggleButton');
        var navbar = document.getElementById('navbar');
        navbarContent.classList.remove('show');
        toggleButton.style.display = 'block'; // Show the toggle button
        navbar.style.paddingLeft = '0'; // Remove left padding
        navbar.style.backgroundColor = 'transparent'; // Reset navbar background color
    }

    // Add click event listener to the toggle button
    document.getElementById('toggleButton').addEventListener('click', toggleNavbar);

    // Add click event listener to the close button
    document.querySelector('.close-btn').addEventListener('click', hideNavbar);
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</div>
