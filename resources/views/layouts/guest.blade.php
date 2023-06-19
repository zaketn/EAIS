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
        @vite(['resources/css/app.css', 'resources/css/Plugins/flowbite.min.css'])
    </head>
    <body class="font-sans text-gray-900 antialiased dark:bg-gray-900">
        <div class="container mx-auto my-auto">
            <div class="flex flex-col h-screen sm:justify-center items-center pt-6 sm:pt-0">
                <div class="font-sans text-5xl text-gray-600 w-50 text-center my-8">
                    <a href="{{ route('home') }}">Сопровождение гос. поддержки МСП</a>
                </div>
                <div class="font-sans text-2xl text-gray-600 w-50 text-center">
                    <p>{{ $formTitle ?? '' }}</p>
                </div>
                <div class="max-w-md w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                    {{ $slot }}
                </div>
            </div>
        </div>

        @vite(['resources/js/app.js', 'resources/js/Plugins/flowbite.min.js'])
        <script>
            const themeInit = () => {
                const localStorageTheme = localStorage.getItem('theme')

                if(localStorage.getItem('theme')){
                    document.documentElement.classList.add(localStorageTheme);
                } else {
                    localStorage.setItem('theme', 'light');
                    document.documentElement.classList.add('light');
                }
            }
            themeInit()
        </script>
    </body>
</html>
