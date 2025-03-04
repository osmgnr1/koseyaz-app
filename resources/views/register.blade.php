@extends('layouts.app')
@section('content')

{{-- @livewire('register-passwords') --}}

    <div class="w-3/4 justify-self-center px-10 border-2 border-blue-500 rounded-xl">
        <h2 class="my-4 text-4xl tracking-tight font-bold text-center">Üye Ol</h2>

        <form action="#" class="" method="POST">
            @csrf
            <div class="flex-col mb-4">
                <label for="email" class="block mb-1">Email</label>
                <input type="email" name="email" id="email" class="w-full rounded-md py-2 px-4 text-sm border border-blue-500 focus:outline-none focus:border-blue-500 focus:ring-blue-500 focus:ring-1" placeholder="Email adresinizi giriniz" required>
            </div>


            @livewire('register-passwords')

            {{-- <div class="flex-col mb-4">
                <label for="password" class="block mb-1">Şifre</label>
                <input type="password" name="password" id="password" class="w-full rounded-md py-2 px-4 text-sm border border-blue-500 focus:outline-none focus:border-blue-500 focus:ring-blue-500 focus:ring-1" placeholder="Şifrenizi giriniz" required>
            </div> --}}


            <div class="flex-col mb-4">
                <label for="confirm_password" class="block mb-1">Şifre Onayla</label>
                <input type="password" name="confirm_password" id="confirm_password" class="w-full rounded-md py-2 px-4 text-sm border border-blue-500 focus:outline-none focus:border-blue-500 focus:ring-blue-500 focus:ring-1" placeholder="Şifrenizi tekrar giriniz" required>
            </div>
            <div class="flex-col mb-4 text-center">
                <button type="submit" class="font-semibold w-1/2 border border-blue-400 p-2 px-6 rounded-2xl bg-sky-300 text-md hover:bg-sky-500">Üye Ol</button>
            </div>
        </form>
    </div>

@endsection
