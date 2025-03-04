{{-- @extends('layouts.appc')
@section('content') --}}

<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hoşgeldiniz!') }}
        </h2>
    </x-slot>

    {{-- <div class="w-1/2 justify-self-center px-10 py-6 mt-5 border-2 border-slate-400 rounded-xl">
<div class="grid grid-cols-1 gap-5 "> --}}

    <div class="flex flex-col sm:justify-center items-center my-5">
        <div
            class="grid grid-cols-1 gap-5 sm:gap-3 sm:text-xs w-full sm:max-w-md mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg ">


            <div class="flex gap-2">
                <div>
                    <x-home-pencil-component></x-home-pencil-component>
                </div>
                <div>
                    <p class="font-semibold text-base text-gray-600 leading-tight">
                        {{ __('Köşe yazısı yazmak hiç bu kadar kolay olmamıştı.') }}</p>
                </div>
            </div>

            <div class="flex gap-2">
                <div>
                    <x-home-pencil-component></x-home-pencil-component>
                </div>
                <div>
                    <p class="font-semibold text-base text-gray-600 leading-tight">
                        {{ __('Üyelik oluşturarak hemen yazmaya başlayabilirsin.') }}</p>
                </div>
            </div>

            <div class="flex gap-2">
                <div>
                    <x-home-pencil-component></x-home-pencil-component>
                </div>
                <div>
                    <p class="font-semibold text-base text-gray-600 leading-tight">
                        {{ __('Zaten üye isen, giriş yaparak günlük yazılarını yazmaya başlayabilirsin.') }}</p>
                </div>
            </div>

            <div class="flex gap-2">
                <div>
                    <x-home-pencil-component></x-home-pencil-component>
                </div>
                <div>
                    <p class="font-semibold text-base text-gray-600 leading-tight">
                        {{ __('Ne üye olmak ne de giriş yapmak istemiyorsan, yazılarımıza göz atarak gündem ile ilgili yazıları takip edebilirsin.') }}
                    </p>
                </div>
            </div>

        </div>

        @auth
        @else
            <div class="flex gap-5 pt-10">
                <div>
                    {{-- <a href="{{ route('login') }}" class="font-semibold text-gray-600 leading-tight w-1/2 border border-blue-400 p-2 px-6 rounded-2xl bg-sky-300 text-base hover:bg-sky-500">{{ __('Login') }}</a> --}}
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">{{ __('Login') }}</a>
                </div>
                <div>
                    {{-- <a href="{{ route('register') }}" class="font-semibold text-gray-600 leading-tight w-1/2 border border-blue-400 p-2 px-6 rounded-2xl bg-sky-300 text-base hover:bg-sky-500">Üye Ol</a> --}}
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">{{ __('Register') }}</a>
                </div>
            </div>
        @endauth

</x-app-layout>

{{-- @endsection --}}
