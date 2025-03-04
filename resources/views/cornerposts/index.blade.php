{{-- @extends('layouts.appc')
@section('content') --}}
<x-app-layout>

    <x-slot name="header">
        <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 justify-between items-center">
            <div>
                <h2 class="font-semibold text-lg sm:text-xl text-gray-800 leading-tight">
                    {{ __('Yazıları filtreleyerek okuyabilirsiniz!') }}
                </h2>
            </div>
            <div>
                <form action="{{ route('cornerposts.search') }}" method="GET">
                    <div class="flex space-x-10 justify-center items-center">
                        <div class="flex border-1 border-blue-500 overflow-hidden max-w-md font-[sans-serif]">
                            <input type="text" name="search" placeholder="{{ __('Search') }}" value="{{ request('search')}}"
                                class="w-full outline-none bg-white text-gray-600 text-sm px-4 py-3" />
                            <x-primary-button type='submit'
                                class="flex items-center justify-center bg-blue-600 px-5 text-sm text-white hover:bg-blue-400">
                                {{ __('Search') }}
                            </x-primary-button>
                        </div>
                        <div>
                            <select name="filter" id="filter">
                                <option value="" class="text-xs sm:text-base italic text-slate-400">{{ __('Choose Filter') }}</option>
                                <option value="all" class="text-xs sm:text-base text-slate-800">{{ __('All Cornerposts') }}</option>
                                <option value="title" class="text-xs sm:text-base text-slate-800">{{ __('Title') }}</option>
                                <option value="script" class="text-xs sm:text-base text-slate-800">{{ __('Script') }}</option>
                                <option value="author" class="text-xs sm:text-base text-slate-800">{{ __('Author') }}</option>
                                <option value="category" class="text-xs sm:text-base text-slate-800">{{ __('Category') }}</option>
                                <option value="tag" class="text-xs sm:text-base text-slate-800">{{ __('Tag') }}</option>
                            </select>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger text-red-600">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>&#8727;{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </x-slot>


    <div class="w-full sm:w-1/2 px-3 justify-self-center">
        @foreach ($cornerposts as $cornerpost)
            <x-corner-post :cornerpost="$cornerpost"></x-corner-post>
        @endforeach
        <div class="pt-8 pb-16">
            @if (isset($params))
            {{ $cornerposts->appends($params)->links('vendor.pagination.tailwind') }}
            @else
            {{ $cornerposts->links('vendor.pagination.tailwind') }}
            @endif


        </div>
    </div>
</x-app-layout>

{{-- @endsection --}}
