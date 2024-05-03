<!-- Navbar.blade.php -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

<script>
    $(document).ready(function(){
        $("#toggleButton").click(function(event){
            event.stopPropagation();
            
            if(!$("#navbarContent").hasClass("column")){
                $("#navbarContent").addClass("column");
                //$("#navbarContent").stop().show();
                $("#navbarContent").stop().animate({width: "300px"});
                $("#overlay").fadeIn();
            }
            else{
                $("#navbarContent").animate({width: "0px"});
                $("#navbarContent").removeClass("column");
                $("#overlay").fadeOut();
            }
        });

        $(".dashboard").click(function(event){
            event.stopPropagation();

            if(!$("#dashboardContent").hasClass("column")){
                $("#dashboardContent").addClass("column");
                $("#dashboardContent").show();
                if($("#dashboardContent").hasClass("loggedIn")){
                    $("#dashboardContent").stop().animate({height: "40px"});
                }
                else{
                    $("#dashboardContent").stop().animate({height: "65px"});
                }
                $("#overlay").fadeIn();
            }
            else{
                $("#dashboardContent").animate({height: "0px"});
                $("#dashboardContent").removeClass("column");
                $("#dashboardContent").hide();
                $("#overlay").fadeOut();
            }
        });

        $(window).click(function(){
            $("#overlay").fadeOut();

            if($("#navbarContent").hasClass("column")){
                $("#navbarContent").animate({width: "0px"});
                $("#navbarContent").removeClass("column");
            }

            if($("#dashboardContent").hasClass("column")){
                $("#dashboardContent").animate({height: "0px"});
                $("#dashboardContent").removeClass("column");
                $("#dashboardContent").hide();
            }
        });
    });
</script>

<style>
    a {
        text-decoration: none;
        color:black;
    }

    .navbar {
        justify-content: space-between;
        position: relative;
        transition: padding-left 0.3s ease, background-color 0.3s ease;
        background-color: transparent;
        padding: nonel
    }

    .toggle-navbar {
        background: none;
        border: none;
        cursor: pointer;
        padding: 5px;
        position: absolute;
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

    #navbarContent{
        position: fixed;
        z-index: 1056;
        height: auto;
        width: 0;
        top: 8%;
        left: .8%;
    }

    .column{
        display: flex !important;
        flex-direction: column;
        align-items: flex-start;
        background-color: white;
    }

    /* New styles for hover effects */
    .navbar-link {
        position: relative;
      font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
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

    #banner{
        display: flex;
        justify-content: space-between;
        height: 12%;
        align-items: center;
        background-image: linear-gradient(to right, rgba(255, 255, 255, 0.922), white);
        padding: 10px;
    }

    .dashboard{
        width: 35px;
        height: 35px;
    }

    #dashboardContent{
        display: none;
        width: 5%;
        position: fixed;
        top: 8%;
        left: 94.3%;
        height: 0px;
        z-index: 1056;
    }

    #overlay{
        position: fixed;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.685);
        z-index: 1055;
        display: none;
    }
   
</style>

<div id="overlay">

</div>

<!-- Button to toggle navbar -->

<div id="banner" class="sticky-top">
    <div class="navbar" id="navbar">
        <!-- Button to toggle navbar -->
        <button id="toggleButton" class="toggle-navbar btn btn-primary">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>

    <img src="{{ asset('/storage/images/Logo.png') }}" alt="ShiftHappensMotors Logo" style="max-width: 100px;" class="navbar-link">

    <ion-icon name="person-circle-outline" class="dashboard md hydrated" role="img"></ion-icon>

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
        <x-nav-link :href="route('sell.parts')" :active="request()->routeIs('sell.parts')" class="navbar-link">
            {{ __('Order Parts') }}
        </x-nav-link>
        <x-nav-link :href="route('schedule.maintenance')" :active="request()->routeIs('schedule.maintenance')" class="navbar-link">
            {{ __('Schedule Maintenance') }}
        </x-nav-link>
        <x-nav-link :href="route('payment.form')" :active="request()->routeIs('payment.form')" class="navbar-link">
            {{ __('Make a Payment') }}
        </x-nav-link>
    @endif

    {{-- Checks if the current user is not logged in --}}
    @if (Auth::user() === null)
        <x-nav-link :href="route('sell.parts')" :active="request()->routeIs('sell.parts')" class="navbar-link">
            {{ __('Order Parts') }}
        </x-nav-link>
        <x-nav-link :href="route('schedule.maintenance')" :active="request()->routeIs('schedule.maintenance')" class="navbar-link">
            {{ __('Schedule Maintenance') }}
        </x-nav-link>
        <x-nav-link :href="route('ratings.create')" :active="request()->routeIs('ratings.create')" class="navbar-link">
            {{ __('Rate an Employee') }}
        </x-nav-link>
    @endif
</div>



@if (Auth::user() != null)
    <div id="dashboardContent" class="loggedIn">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="navbar-link" class="navbar-link">
            {{ __('Dashboard') }}
        </x-nav-link>
    </div>
@else
    <div id="dashboardContent">
        <x-nav-link :href="route('login')" :active="request()->routeIs('login')" class="navbar-link" class="navbar-link">
            {{ __('Login') }}
        </x-nav-link>
        <x-nav-link :href="route('register')" :active="request()->routeIs('register')" class="navbar-link" class="navbar-link">
            {{ __('Register') }}
        </x-nav-link>
    </div>
@endif






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}


</div>
