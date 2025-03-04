{{-- @extends('layouts.appc')
@section('content') --}}

<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Kategori adı: ') }} {{ Str::upper($category_name) }}
    </h2>

</x-slot>

<div class="w-full sm:w-1/2 px-3 justify-self-center">
@foreach ($cornerposts as $cornerpost)

<x-corner-post :$cornerpost></x-corner-post>

@endforeach
<div class="pt-4 sm:pt-8 pb-8 sm:pb-16">
    {{ $cornerposts->links('vendor.pagination.tailwind') }}
</div>
</div>
</x-app-layout>
{{-- @endsection --}}
