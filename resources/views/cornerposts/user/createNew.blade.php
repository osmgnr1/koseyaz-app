<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Write') }}
        </h2>
    </x-slot>

    {{-- <div class="py-6">
        <div class="w-full sm:w-1/2 mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm rounded-lg"> --}}

                <div class="p-6 text-gray-900 grid grid-cols-1 gap-5 justify-items-center">

                    @if ($errors->any())
                        <div class="alert alert-danger text-red-600">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>&#8727;{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form class="w-full sm:w-3/4 grid grid-cols-1 gap-5 p-5" action="{{ route('dashboard.cornerpost.store') }}"
                        method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="grid grid-cols-1 text-xs sm:text-base">
                            <label class="font-bold" for="title">Başlık</label>
                            <input value="{{ old('title') }}" class="rounded-md text-xs sm:text-base" name="title" id="title"
                                placeholder="Başlığı buraya yazınız. Kelime sayısı en az 1 en fazla 10 olmalıdır.">
                        </div>

                        <x-summernote></x-summernote>

                        <div class="flex justify-between sm:justify-start sm:space-x-10 items-center text-xs sm:text-base">
                            <label class="font-bold">Kategori Seçiniz</label>
                            <select id="category_id" name="category_id" class="rounded-md text-xs sm:text-base">
                                <option value="" class="text-xs sm:text-base text-slate-400 italic">Kategori seçiniz</option>
                                @foreach ($categories as $category)
                                    <option class="text-xs sm:text-base text-slate-800" value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <x-select2-tags :tagsdb="$tagsdb"></x-select2-tags>

                        <div class="grid grid-cols-1 gap-5 justify-items-center">
                            <x-primary-button id="btnSubmitCornerPost" name="submit" class="pr-10 pl-10">{{ __('Submit') }}</x-primary-button>
                        </div>
                    </form>
                </div>

            {{-- </div>
        </div>
    </div> --}}

</x-app-layout>
