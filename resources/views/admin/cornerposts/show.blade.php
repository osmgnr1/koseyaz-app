{{-- @extends('layouts.appc')

@section('content') --}}
<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Onay') }}
    </h2>
</x-slot>

<div class="grid grid-cols-1 gap-5 w-full sm:w-1/2 justify-self-center mb-8 px-10 mt-5 border-2 border-blue-500 rounded-xl">

    <div class="grid grid-cols-1 gap-0">
        <div>
            <h2 class="pt-5 text-lg font-medium">{{ $cornerpost->title }}</h2>
        </div>

        {{-- <div class="text-slate-500">
            <p>{{ $cornerpost->user->name }} tarafından {{ \Carbon\Carbon::parse($cornerpost->published_at)->diffForHumans() }} oluşturuldu.</p>
        </div> --}}
    </div>

    <div class="grid grid-cols-1 gap-4">
        {{-- <div class="text-slate-500 text-justify">
            {{ $cornerpost->entry }}
        </div> --}}
        <div class="text-slate-500 text-justify">
            {!! $cornerpost->body !!}
        </div>
        {{-- <div class="text-slate-500 text-justify pb-10">
            {{ $cornerpost->conclusion }}
        </div> --}}
    </div>

</div>
</x-app-layout>
{{-- @endsection --}}

