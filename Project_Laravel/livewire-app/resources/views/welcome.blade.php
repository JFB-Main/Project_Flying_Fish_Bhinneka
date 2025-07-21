<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
            </style>
        @endif

        @livewireStyles

        {{-- <script src="https://cdn.tailwind.css"></script> --}}
    </head>
    <body id="dashboard"  class="antialiased flex flex-row bg-[#FFFAF3]">
        <nav class="fixed top-0 left-0 w-64 flex flex-col h-screen outline outline-solid outline-[#E6D08E] " style="">
            <div class="bg-[#F8971A] w-full h-min pt-3 pb-3">
                <div class="flex flex-row gap-2 items-center justify-baseline pl-5">
                    <img src="{{ asset('icon_nav/flyingfish-icon.png') }}" alt="" style="width: 20%; height: 20%;">
                    <h1 class="text-[#FFF8DE] font-bold text-xl">
                    Flying Fish
                    </h1>
                </div>
            </div>
            <div class="w-full bg-white h-full pl-5 gap-6">
                <div class="flex flex-col pt-5 gap-6 items-baseline [&>*]:hover:font-semibold [&>*]:hover:text-[#F8971A] [&>*]:active:bg-[#EDE9E6] [&>*]:hover:rounded-2xl [&>*]:pl-1 [&>*]:pr-2 [&>*]:gap-3">
                    <div class="flex flex-row items-start">
                        <img src="{{ asset('icon_nav/dashboard_icon.svg') }}" alt="" style="width: 30px;">
                        <form action="{{ url('/') }}">
                            <button x-data x-on:click="$Livewire.emit('setPageTitle', 'dd')" class="text-xl ">
                                <span>
                                    Dashboard
                                </span>
                            </button>
                        </form>
                    </div>
                    <div class="flex flex-row items-start">
                        <img src="{{ asset('icon_nav/service_icon.svg') }}" alt="" style="width: 30px;">
                        <button class="text-xl">
                            <span>
                                Service
                            </span>
                        </button>
                    </div>
                    <div class="flex flex-row items-start">
                        <img src="{{ asset('icon_nav/logout_icon.svg') }}" alt="" style="width: 30px;">
                        <form action="{{route('auth.logout')}}">
                            <button class="text-xl">
                                <span>
                                    logout
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        <div class="ml-64 flex flex-col overflow-y-auto gap-10" style="width: 100%;">
            @livewire('clicker', ['message' => "fff"])
            @livewire('dashboard')
            <button x-data x-on:click="$dispatch('open-modal', {name : 'test'})" x-transition:enter="transition ease-out duration-300" class="bg-orange-100 w-md">
                Open Modal
            </button>
        </div>

        {{-- @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif --}} 

        @livewireScripts
    </body>
    <script>
    function toggleScroll() {
    const dashboardElement = document.getElementById('dashboard');

    if (dashboardElement) {
        // Check the current value of the inline 'overflow' style
        // If it's currently 'hidden', change it to 'auto' (or 'scroll' if you prefer)
        // If current overflow is hidden, set it to 'auto'
        if (dashboardElement.style.overflow === 'hidden') {
            dashboardElement.style.overflow = 'auto'; // Or 'scroll', depending on preference
        }
        // If current overflow is 'scroll' or 'auto', set it to 'hidden'
        else if (dashboardElement.style.overflow === 'scroll' || dashboardElement.style.overflow === 'auto') {
            dashboardElement.style.overflow = 'hidden';
        }
        // Handle cases where the inline style might be empty or 'visible' initially
        // You might want a default behavior if it's not explicitly 'hidden', 'scroll', or 'auto'
        else {
            dashboardElement.style.overflow = 'hidden'; // Default to hiding overflow
        }
    } else {
        console.warn("Element with ID 'dashboard' not found.");
    }

    }

    function toggleKeydownScroll() {
        const popUpElement = document.getElementById('pop-up');
        const dashboardElement = document.getElementById('dashboard');

        if (popUpElement) {

            if (popUpElement.style.display !== 'none') {
                dashboardElement.style.overflow = 'auto'; // Or 'scroll', depending on preference
            }
        } else {
            console.warn("Element with ID 'pop-up' not found.");
        }

    }
</script>
</html>
