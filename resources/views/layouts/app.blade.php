<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sfibras') }}</title>
        <link  rel="icon" href="{{Storage::url('cliente/favicon.png')}}" type="image/png" />

        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

        {{-- LightGallery JS --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css" integrity="sha512-kwJUhJJaTDzGp6VTPBbMQWBFUof6+pv0SM3s8fo+E6XnPmVmtfwENK0vHYup3tsYnqHgRDoBDTJWoq7rnQw2+g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/cliente.css') }}">

        {{-- Font awesome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        {{-- SWIPER JS CSS --}}
        <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        @livewireStyles

        @stack('css')
    </head>
    <body class="font-sans antialiased">
        {{-- <div class="min-h-screen bg-gray-100"> --}}
            @include('layouts.navigation')

            <!-- Page Heading -->
            {{-- @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif --}}


            <!-- Page Content -->
            <main class="bg-gray-100">
                {{ $slot }}
            </main>

            @include('layouts.footer')
        {{-- </div> --}}


        {{-- LightGallery JS --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/js/lightgallery.min.js" integrity="sha512-b4rL1m5b76KrUhDkj2Vf14Y0l1NtbiNXwV+SzOzLGv6Tz1roJHa70yr8RmTUswrauu2Wgb/xBJPR8v80pQYKtQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        {{-- Swiper JS --}}
        <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

        <script src="{{ asset('js/cliente.js') }}" ></script>

        @livewireScripts

        @stack('js')

        <script>
            lightGallery(document.querySelector(['.servicios-page .content .content-service .imgs-servicio','.trabajos-page .gallery-trabajos']),{
                download:false,
            });
        </script>
    </body>
</html>
