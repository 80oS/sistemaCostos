<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .math-wallpaper {
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(135deg, rgb(230, 240, 255) 0%, rgb(180, 210, 255) 100%),
                radial-gradient(circle at 20% 20%, rgba(25, 75, 180, 0.8) 0.1em, transparent 0.1em),
                radial-gradient(circle at 40% 60%, rgba(25, 75, 180, 0.8) 0.1em, transparent 0.1em),
                radial-gradient(circle at 60% 30%, rgba(25, 75, 180, 0.8) 0.1em, transparent 0.1em),
                radial-gradient(circle at 80% 70%, rgba(25, 75, 180, 0.8) 0.1em, transparent 0.1em);
            background-size: 100% 100%, 10em 10em, 10em 10em, 10em 10em, 10em 10em;
            background-repeat: no-repeat, repeat, repeat, repeat, repeat;
            position: relative;
        }

        .math-wallpaper::before,
        .math-wallpaper::after {
            content: "+ - × ÷";
            position: absolute;
            color: rgba(25, 75, 180, 0.8);
            font-family: monospace;
            font-size: 14px;
        }

        .math-wallpaper::before {
            top: 25%;
            left: 33%;
        }

        .math-wallpaper::after {
            bottom: 40%;
            right: 20%;
        }
    </style>
    <body class="font-sans antialiased">
        <x-banner />

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

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
    
            @yield('content')
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
