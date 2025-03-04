

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
                                    <li>&#8727;{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form class="w-1/2 grid grid-cols-1 gap-5" action="{{ route('dashboard.cornerpost.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1">
                            <label for="title">Başlık</label>
                            <input value="{{old('title')}}" class="rounded-md" name="title" id="title" placeholder="Başlığı buraya yazınız. Kelime sayısı en az 1 en fazla 10 olmalıdır.">
                        </div>
                        <div class="grid grid-cols-1">
                            <label for="entry">Giriş Bölümü</label>
                            <textarea class="rounded-md" name="entry" id="entry" cols="30" rows="5" placeholder="Giriş bölümünü buraya yazınız. Kelime sayısı en az 50 en fazla 100 olmalıdır.">{{ old('entry') }}</textarea>
                        </div>
                        <div class="grid grid-cols-1">
                            <label for="body">Gelişme Bölümü</label>
                            <textarea style="resize: none" class="rounded-md" name="body" id="body" cols="30" rows="8" placeholder="Gelişme bölümünü buraya yazınız. Kelime sayısı en az 200 en fazla 1000 olmalıdır.">{{ old('body') }}</textarea>
                        </div>



                        <div class="mb-10 grid grid-cols-1">
                            <label for="body">Gelişme Bölümü</label>
                            @livewire('quill-text-editor')

                        </div>



                        <div class="grid grid-cols-1">
                            <label for="conclusion">Sonuç Bölümü</label>
                            <textarea class="rounded-md" name="conclusion" id="conclusion" cols="30" rows="4" placeholder="Sonuç bölümünü buraya yazınız. Kelime sayısı en az 100 en fazla 200 olmalıdır.">{{ old('conclusion') }}</textarea>
                        </div>

                        <div class="grid grid-cols-1">
                            <label>Kategori Seçiniz</label>
                            <select name="category_id" class="rounded-md">
                                <option value="" class="italic">Kategori seçiniz</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ (old("category_id") == $category->id ? "selected":"") }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-1">
                            <label>Etiket Ekle <span></span></label>

                            <select name="tags[]" multiple class="h-60">
                                <option disabled>2-5 arasında etiket seçiniz</option>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}" {{ (collect(old('tags'))->contains($tag->id)) ? 'selected':'' }} >{{ $tag->name }}</option>
                                @endforeach
                            </select>


                        </div>

                        <div class="grid grid-cols-1 gap-5 justify-items-center">
                            <x-primary-button class="pr-10 pl-10">{{ __('Submit')}}</x-primary-button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
