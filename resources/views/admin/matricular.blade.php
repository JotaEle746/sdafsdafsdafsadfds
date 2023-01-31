<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

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
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            <main>
                <div class="row">
                    <div class="col text-center mt-2">
                        <h1>CURSOS Y CERTIFICADOS</h1>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col text-start">
            
                        <h4>Cursos: {{ $curso->nombre }} </h4>
                        <hr>
                        <div class="card mt-2">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('mostrarponentes', $curso->id) }}">Ponentes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route( 'mostrarparticipantes', $curso->id ) }}">Inscripciones</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="{{ route( 'matricularnew', $curso->id ) }}">Matricular</a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <div>
                                    <div>
                                        <div class="card-body">
                                            @livewire('admin.inscripcion-curso', [$curso])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                'Good job!',
                message,
                'success'
                )
            })
        </script>
    </body>
</html>