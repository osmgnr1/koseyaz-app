<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bildirimlerim') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="bg-gray-200 h-auto w-full justify-center items-center">

                    <div style="background-color: rgb(51 65 85 / var(--tw-bg-opacity, 1));" class="rounded-md pl-5 py-5">
                        <p class="text-white"><b>{{ $count }}</b> adet yeni bildiriminiz var!</p>
                    </div>

                    <div class="max-w-7xl mx-auto px-4 py-5 sm:px-6 lg:py-10 lg:px-8">

                        <div class="bg-white shadow-sm h-96 sm:rounded-lg overflow-auto">
                            @foreach ($notifications as $not)
                                <div class="bg-slate-600 p-3 m-2 rounded-md">
                                    @if ($not->data['type'] == 'like')
                                        <div class="flex items-center space-x-2">
                                            <span
                                                class="rounded-md text-center text-sm text-red-500 transition-all shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="w-4 h-4">
                                                    <path
                                                        d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                                                </svg>
                                            </span>

                                            <p class="text-white text-xs sm:text-sm">{{ $not->data['username'] }}, <span
                                                    class="italic font-medium text-red-300">{{ $not->data['title'] }}</span> başlıklı
                                                köşe yazınızı beğendi..! </p>
                                        </div>
                                    @elseif ($not->data['type'] == 'dislike')

                                    <div class="flex items-center space-x-1">

                                        <span class="rounded-md text-center text-sm text-slate-100 transition-all shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-4 h-4" className="size-6">
                                                <path strokeLinecap="round" strokeLinejoin="round" d="M12 9.75 14.25 12m0 0 2.25 2.25M14.25 12l2.25-2.25M14.25 12 12 14.25m-2.58 4.92-6.374-6.375a1.125 1.125 0 0 1 0-1.59L9.42 4.83c.21-.211.497-.33.795-.33H19.5a2.25 2.25 0 0 1 2.25 2.25v10.5a2.25 2.25 0 0 1-2.25 2.25h-9.284c-.298 0-.585-.119-.795-.33Z" />
                                              </svg>
                                        </span>

                                        <span
                                            class="rounded-md text-center text-sm text-red-500 transition-all shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="w-4 h-4">
                                                <path
                                                    d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                                            </svg>
                                        </span>

                                        <p class="text-white text-xs sm:text-sm">{{ $not->data['username'] }}, <span
                                                class="italic font-medium text-red-100">{{ $not->data['title'] }}</span> başlıklı
                                            köşe yazınızı beğenmekten vazgeçti..! </p>
                                    </div>

                                    @else

                                        <div class="flex items-center space-x-2">

                                            <span class="rounded-md text-center text-sm text-slate-200 transition-all shadow-sm">

                                            <svg xmlns="http://www.w3.org/2000/svg"  class="w-5 h-5" fill="white" viewBox="0 0 24 24" strokeWidth={1.5} stroke="black" className="size-6">
                                                <path strokeLinecap="round" strokeLinejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                            </span>

                                            <p class="text-white text-xs sm:text-sm">{{ $not->data['username'] }}, <span
                                                    class="italic font-medium text-yellow-200">{{ $not->data['title'] }}</span> başlıklı
                                                köşe yazınıza yorum yaptı..! </p>
                                        </div>



                                    @endif

                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
