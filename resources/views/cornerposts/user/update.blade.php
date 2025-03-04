{{-- @extends('layouts.app')
@section('content') --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Köşe Yaz') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 grid grid-cols-1 gap-5 justify-items-center">

                    @if ($errors->any())
                        <div class="alert alert-danger text-red-600">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form class="w-1/2 grid grid-cols-1 gap-5" action="{{ route('dashboard.cornerpost.update.store') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <input name="id" id="id" type="hidden" value="{{ $cornerpost->id }}">
                        </div>
                        <div class="grid grid-cols-1">
                            <label for="title">Başlık</label>
                            <input value="{{ $cornerpost->title }}" class="rounded-md" name="title" id="title" placeholder="Başlığı buraya yazınız." required>
                        </div>
                        <div class="grid grid-cols-1">
                            <label for="entry">Giriş Bölümü</label>
                            <textarea class="rounded-md" name="entry" id="entry" cols="30" rows="5" placeholder="Giriş bölümünü buraya yazınız. 1 paragraftan oluşan bir giriş yapınız." required>{{ $cornerpost->entry }}</textarea>
                        </div>
                        <div class="grid grid-cols-1">
                            <label for="body">Gelişme Bölümü</label>
                            <textarea class="rounded-md" name="body" id="body" cols="30" rows="8" placeholder="Gelişme bölümünü buraya yazınız" required>{{ $cornerpost->body }}</textarea>
                        </div>

                        <div class="grid grid-cols-1">
                            <label for="conclusion">Sonuç Bölümü</label>
                            <textarea class="rounded-md" name="conclusion" id="conclusion" cols="30" rows="4" placeholder="Sonuç bölümünü buraya yazınız" required>{{ $cornerpost->conclusion }}</textarea>
                        </div>

                        <div class="grid grid-cols-1">
                            <label for="category">Kategori Seçiniz</label>
                            <select name="category_id" class="rounded-md">
                                <option value="" class="italic">Kategori seçiniz</option>
                                @foreach ($categories as $category)

                                    <option value="{{ $category->id }}" {{ $cornerpost->category_id == $category->id ? "selected":"" }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-1">
                            <label for="tags[]">Etiket Ekle</label>
                            {{-- <livewire:tag-selector :$tags/> --}}

                            <select name="tags[]" multiple class="h-60">
                                <option disabled>2-5 arasında etiket seçiniz</option>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}" {{ $cornerpost->tag->contains($tag->id) ? 'selected':'' }} >{{ $tag->name }}</option>
                                @endforeach
                            </select>


                        </div>

                        <div class="grid grid-cols-1 gap-5 justify-items-center">
                            {{-- <input class="border border-1 rounded-xl border-blue-400 px-20 py-2 cursor-pointer hover:bg-blue-400" type="submit" value="Güncelle"> --}}
                            <x-primary-button class="ms-4 px-10">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
{{-- @endsection --}}
