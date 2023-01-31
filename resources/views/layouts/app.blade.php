<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Cursos y Certificados') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        {{-- <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet"> --}}

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- Styles -->
        @livewireStyles
        @stack('css')
    </head>
    <body class="font-sans antialiased">
        @extends('adminlte::page')
        @section('content')
        <x-jet-banner /> 
        <div class="min-h-screen bg-gray-100">
            @livewire('enaving')
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main>
                {{ $slot }}
            </main>
        </div>
        @stop
{{-- 
        @extends('adminlte::page')
        @section('title', 'Dashboard')
        @section('content')
        <x-jet-banner />
        <div class="min-h-screen bg-gray-100">
            <main>
                {{ $slot }}
            </main>
        </div> --}}

        @stack('modals')

        @livewireScripts
        @stack('js')
        <script>
            Livewire.on('alert', function(message){
                Swal.fire(
                'Buen trabajo!',
                message,
                'success'
                )
            })
        </script>
    </body>
</html>
