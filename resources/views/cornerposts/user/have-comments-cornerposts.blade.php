<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Have Comments') }}
        </h2>
    </x-slot>

    {{-- <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg"> --}}

                    <div class="w-1/2 justify-self-center">
                        @foreach ($cornerposts as $cornerpost)
                        <x-corner-post :$cornerpost></x-corner-post>
                        @endforeach
                    </div>

                    <div class="pt-8 pb-16">
                            {{-- {{ $cornerposts->links('vendor.pagination.tailwind') }} --}}
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
