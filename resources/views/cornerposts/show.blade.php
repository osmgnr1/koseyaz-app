{{-- @extends('layouts.appc')

@section('content') --}}
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Oku!') }}
        </h2>
    </x-slot>

    <style>
        h1 {
            font-size: 2em;
        }

        h2 {
            font-size: 1.5em;
        }

        h3 {
            font-size: 1.17em;
        }

        h4 {
            font-size: 1em;
        }

        img {
            justify-self: center
        }

        ul {
            list-style: disc !important;
            list-style-position: inside !important;
        }

        ol {
            list-style: decimal !important;
            list-style-position: inside !important;
        }

        img{

            /* padding-left: 1px;
            padding-right: 2px;
            padding-top: 2px;
            padding-bottom: 2px; */

            margin-left: 10px;
            margin-right: 10px;
            margin-top: 5px;
            margin-bottom: 5px;
        }
    </style>

    <div class="grid grid-cols-1 gap-5 w-full sm:w-2/3 justify-self-center px-10 py-2 border-2 border-slate-500 rounded-xl">

        <div class="grid grid-cols-1 gap-0">
            <div>
                <h1 class="text-2xl sm:text-3xl pt-5 font-medium">{{ $cornerpost->title }}</h1>
            </div>

            <div class="text-slate-500">
                <a href="{{ route('user.profile', ['user' => $cornerpost->user]) }}">
                    <p>{{ $cornerpost->user->username }}
                </a> {{ __('by') }}
                {{ \Carbon\Carbon::parse($cornerpost->created_at)->diffForHumans() }} yayınlandı</p>
            </div>
            <div class="py-1">
                <hr>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4">
            <div class="text-slate-500 text-justify">
                {!! $cornerpost->body !!}
            </div>
        </div>

        <div class="flex justify-end self-center space-x-5 py-2">

            @auth()
                <livewire:like-component :cornerPostId="$cornerpost->id" />
            @else
                <livewire:post-like-counter :cornerPostId="$cornerpost->id" />
            @endauth
            <livewire:viewers-counter :cornerPostId="$cornerpost->id" />
        </div>

        {{-- Livewire Comment system --}}

        @livewire('comments', ['model' => $cornerpost])

        {{-- Livewire Comment system --}}





        {{-- Make Comment --}}
        {{-- <div class="flex flex-col sm:justify-center pb-0">
            <div class="w-full mt-0 px-5 pb-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                @auth
                <form method="POST" action="{{ route('comment.store') }}">
                    @csrf
                    <!-- Comment Body -->
                    <div class="mt-0">
                        <x-input-label for="body" :value="__('Make a comment')" />
                        <input type="hidden" name="corner_post_id" value="{{ $cornerpost->id }}" />
                        <x-text-area-input :cols="$cols = '5'" :rows="$rows = '1'" name="body" id="body"
                            class="block mt-1 w-full" :value="old('body')"  placeholder="{{__('Make a comment')}}" required />
                        <x-input-error :messages="$errors->get('body')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-1">
                        <x-primary-button class="ms-4 pl-2 pr-2 pt-1 pb-1 bg-blue-600">
                            {{ __('Submit') }}
                        </x-primary-button>
                    </div>
                </form>
                @else
                <div class="mt-0">
                    <x-input-label for="" :value="__('You can make a comment by registering the website')" />
                </div>
                @endauth
            </div>
        </div> --}}
        {{-- Make Comment --}}

        {{-- View Past comments --}}
        {{-- <div class="flex flex-col sm:justify-center items-start pb-5">
            <div class="w-full mt-0 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <x-comment :comments="$cornerpost->comments"/>
            </div>
        </div> --}}
        {{-- View past comments --}}



    </div>
</x-app-layout>
{{-- @endsection --}}
