<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title ?? 'Default Receipt' }}</title>

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

        <style>
            @media print {
                thead {
                    display: table-header-group; /* This is the key property */
                }
                /* Optional: Adjust margin to prevent content overlap with the header */
                /* For example, if your header is 50px tall, set a top margin */
                body {
                    /* margin-top: 32px;  */
                }
                tr {
                    /* Mencegah baris (tr) terpotong di tengah halaman */
                    page-break-inside: avoid !important;
                    /* Properti modern untuk break-inside */
                    break-inside: avoid !important;

                }

                .page-title-container {
                    display: none;
                }


                @page {
                    margin: 0; 
                }
            }
            /* @media print {
               
                .page-title-container {
                    display: none;
                }


                @page {
                    margin: 0; 
                }
            } */
        </style>
        @livewireStyles
    </head>
    <body class="flex flex-col items-center min-h-screen">
        @livewireScripts
        {{-- <div class="h-[297mm] w-[210mm] ">
            
            <header class="fixed print-repeat-header">
                @section('printHeader')
                    <div style="padding: 10px; text-align: center;">
                        <h2 style="margin: 0;">{{ $title ?? 'SERVICE RECEIPT' }}</h2>
                        <small>Document repeats on every page.</small>
                        <img src="{{asset('icon_SLOverview\bhinneka-logo.svg') }}" alt="">
                    </div>
                @show
            </header>

            <main class="relative print-content-body ">
                @yield('contentExportServisDps')
            </main>
        </div> --}}
        <table class="w-[210mm] border-t border-x">
            <thead>
                <tr>
                    <td>
                        <header class="print-repeat-header px-8 py-8">
                            {{-- @section('printHeader') --}}
                                <div class="p-[10px] text-center">
                                    {{-- <h2 style="margin: 0;">{{ $title ?? 'SERVICE RECEIPT' }}</h2>
                                    <small>Document repeats on every page.</small> --}}
                                    <img src="{{asset('icon_SLOverview\bhinneka-logo.svg') }}" class="w-[200px]" alt="">
                                </div>
                            {{-- @show --}}
                        </header>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <main class="flex justify-center">
                            @yield('contentExportServisDps')
                        </main>
                    </td>
                </tr>
            </tbody>
            {{-- <tfoot><tr><td>
                <div class="fixed h-[100px]">&nbsp;</div>
            </td></tr></tfoot> --}}
        </table>


        <script>
            window.onload = function() {
                // Delay print to ensure all styles/content are rendered
                setTimeout(() => {
                    window.print();
                }, 500);
                };
        </script>
    </body>
</html>
