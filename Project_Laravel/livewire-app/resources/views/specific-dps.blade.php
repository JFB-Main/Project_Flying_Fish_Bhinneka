<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <link rel="icon" type="image/png" href="{{ asset('icon_nav/flyingfish-icon.png') }}">


        {{-- <script src="../path/to/flowbite/dist/flowbite.min.js"></script> --}}

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
            </style>
        @endif

        @livewireStyles

    </head>
    <body id="dashboard" class="antialiased flex flex-row min-h-screen bg-gradient-to-tl from-blue-50 via-blue-100/50 to-blue-100">
        @if (auth()->check())
            <x-sidebar-dps>
            </x-sidebar-dps>
        @endif
        <div x-data="{ show: false }"
                x-on:open-sidebar.window="show = !show"
                :class="{ 'max-md:inline': show }"
                x-on:click="$dispatch('open-sidebar')" class="hidden fixed inset-0 bg-[#030D26] opacity-50 z-3">
        </div>

        @if (auth()->check())
        <div class="ml-64 max-xl:ml-44 max-lg:ml-36 max-md:ml-0 flex flex-col overflow-y-auto gap-10" style="width: 100%;">
        @endif
        <div class="flex flex-col overflow-y-auto gap-10" style="width: 100%;">
            @livewire('navbar-dps', ['message' => "fff"])
            {{-- @livewire('clicker', ['message' => "fff"]) --}}
            @yield('dashboardDPSContent')

            @yield('pelangganDPSContent')
            @yield('dataPelangganContent')
            @yield('detailPelangganContent')

            @yield('dataServisContent')
            @yield('addServisContent')
            @yield('detailServisContent')
            @yield('laporanServisContent')
        </div>


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
