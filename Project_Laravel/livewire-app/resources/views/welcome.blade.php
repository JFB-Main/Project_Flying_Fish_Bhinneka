<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />


        {{-- <script src="../path/to/flowbite/dist/flowbite.min.js"></script> --}}

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
            </style>
        @endif

        <style>
            /* @source "../node_modules/flowbite-datepicker"; */
            @import "tailwindcss";
            /* @plugin "flowbite/plugin"; */
            /* @import "flowbite/src/themes/default"; */
            /* @source "../node_modules/flowbite"; */

        </style>

        {{-- <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script> --}}

        {{-- <style>
            @source "../node_modules/flowbite-datepicker";
            @plugin "flowbite/plugin";
            body {
                font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            }
        </style> --}}

        @livewireStyles

        {{-- <script src="https://cdn.tailwind.css"></script> --}}
    </head>
    {{-- class="antialiased flex flex-row bg-gradient-to-tl from-amber-100 via-[#F8971A]/70 to-purple-400 --}}
    {{-- bg-[#FFFAF3] --}}
    <body  x-data="{ show: false }"
            x-on:open-sidebar.window="show = !show"
            :class="{ 'overflow-hidden': show }"
            id="dashboard" class="antialiased relative flex flex-row bg-gradient-to-tl from-amber-100 via-[#ff8c00]/70 to-purple-500">
            {{-- <div x-data x-on:click="$dispatch('open-sidebar')" class="fixed w-32 h-32 bottom-0 right-0 hidden max-md:inline z-3 outline cursor-pointer"></div> --}}
            {{-- <img src="icon_nav\Create_Sphere.svg" alt="" x-data x-on:click="$dispatch('open-sidebar')" class="fixed w-16 h-16 bottom-4 right-4 hidden max-md:inline z-3 cursor-pointer"> --}}
            <x-sidebar >
            </x-sidebar>
            <div x-data="{ show: false }"
                    x-on:open-sidebar.window="show = !show"
                    :class="{ 'max-md:inline': show }"
                    x-on:click="$dispatch('open-sidebar')" class="hidden fixed h-screen inset-0 bg-[#030D26] opacity-50 z-3">
            </div>

        <div class="ml-64 max-xl:ml-44 max-lg:ml-36 max-md:ml-0 flex flex-col overflow-y-auto gap-10" style="width: 100%;">

            @livewire('clicker', ['message' => "fff"])
            @livewire('dashboard')
            {{-- <button x-data x-on:click="$dispatch('open-modal', {name : 'test'})" x-transition:enter="transition ease-out duration-300" class="bg-orange-100 w-md">
                Open Modal
            </button> --}}
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
