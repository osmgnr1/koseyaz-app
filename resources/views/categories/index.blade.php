{{-- @extends('layouts.appc')
@section('content') --}}

<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kategoriler') }}
        </h2>
    </x-slot>

<div class="w-1/2 justify-self-center py-5 mt-5 px-10">
{{-- <div class="py-4">
    <h2 class="font-bold">Kategoriler</h2>
</div> --}}

<div class="grid grid-cols-1 sm:grid-cols-4 gap-4">

    @foreach ($categories as $category)
        <div class="border border-slate-500 rounded-lg justify-items-center hover:bg-slate-400">
            <div>
                <a href="{{ route('categories.show', ['category' => $category]) }}"><p>{{ strtoupper($category->name) }}</p></a>
            </div>
            <div>
                <p class="text-slate-600">{{ $category->cornerposts->whereNotNull('published_at')->count() }}</p>
            </div>
        </div>
    @endforeach

</div>
</div>
</x-app-layout>
{{-- @endsection --}}
