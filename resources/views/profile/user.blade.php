<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->username }}
        </h2>
    </x-slot>

    {{-- <div class="py-12"> --}}
    {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6"> --}}
        <div class="w-full sm:w-1/2 px-3 justify-self-center">
            @foreach ($cornerposts as $cornerpost)
                <x-corner-post :$cornerpost></x-corner-post>
            @endforeach
        </div>
    {{-- </div> --}}
</x-app-layout>
