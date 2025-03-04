<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <script async src="https://www.google.com/recaptcha/api.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @livewireStyles

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.X.X/dist/cdn.min.js"></script> --}}


</head>

<body class="flex flex-col h-screen justify-between font-sans">
    {{-- <div class="min-h-screen bg-red-400"> --}}
    @include('layouts.navigation')

    <!-- Page Heading -->
    @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <!-- Page Content -->
    <main class="mb-auto">
        {{-- @if (session('success'))
                <div role="alert" class="my-8 rounded-md border-l-4 border-green-300 bg-green-100 p-4 text-green-700 opacity-75">
                    <p class="font-bold">Success!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
            <div role="alert"
              class="my-8 rounded-md border-l-4 border-red-300 bg-red-100 p-4 text-red-700 opacity-75">
              <p class="font-bold">Error!</p>
              <p>{{ session('error') }}</p>
            </div>
            @endif --}}
        {{ $slot }}

    </main>
    <footer class="py-10 text-center text-sm border-t-2 bg-slate-200 shadow">
        {{ __('Köşem@2024') }} {{ __('All rights reserved.') }} {{ __('OOG ') }} {{ __('Designed by') }}
    </footer>

    @livewireScripts

</body>

</html>
