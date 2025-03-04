<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @livewireStyles
    @stack('link')
    @stack('select2links')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- @stack('editorjs') --}}


</head>

<body class="flex flex-col h-screen justify-between">

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
        @if (session('success'))
            <div role="alert"
                class="my-2 rounded-md justify-items-center border-l-4 border-green-300 bg-green-100 p-4 text-green-700 opacity-75">
                <p class="font-bold">{{ __('Success') }}</p>
                <p>{{ __(session('success')) }}</p>
            </div>
        @endif

        @if (session('error'))
            <div role="alert"
                class="my-8 rounded-md border-l-4 border-red-300 bg-red-100 p-4 text-red-700 opacity-75">
                <p class="font-bold">{{ __('Error') }}</p>
                <p>{{ __(session('error')) }}</p>
            </div>
        @endif
        {{ $slot }}


    </main>
    <footer class="py-10 text-center text-sm border-t-2 bg-slate-200 shadow">
        {{ __('Köşem@2024') }} {{ __('All rights reserved.') }} {{ __('OOG ') }} {{ __('Designed by') }}

    </footer>

    @livewireScripts

    @stack('scripts')
    @stack('select2scripts')
</body>

</html>
