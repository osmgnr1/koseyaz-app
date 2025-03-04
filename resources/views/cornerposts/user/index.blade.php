<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Köşe Yazılarım') }}
        </h2>
    </x-slot>



    <div class="w-full sm:w-1/2 justify-self-center pb-8 px-3">

        @foreach ($cornerposts as $cornerpost)
            <div class="my-2 p-2 rounded-md border-2 border-slate-500">
                <div class="pb-2">
                    @if ($cornerpost->published_at == null)
                        <p class="text-red-500">Yayın aşamasında. <span class="text-xs text-slate-600">Yazı kontrol ediliyor. En kısa sürede yayına alınacaktır.</span></p>
                    @endif
                </div>

                <div class="pb-2">
                    <h2 class="text-lg font-medium font-sans text-slate-500 hover:text-slate-900">
                        <a href="{{ route('cornerposts.show', ['cornerpost' => $cornerpost]) }}">{{ $cornerpost->title }}</a>
                    </h2>
                </div>

                <div class="mb-4 flex-col justify-between text-slate-500">

                    <div class="flex gap-2 text-slate-500 items-center">
                        <div>
                            <svg fill="#000000" width="18px" height="18px" viewBox="0 0 24 24" id="Outline"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0" />
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                                <g id="SVGRepo_iconCarrier">
                                    <title>194 restore</title>
                                    <path
                                        d="M12,6a1,1,0,0,0-1,1v5a1,1,0,0,0,.293.707l3,3a1,1,0,0,0,1.414-1.414L13,11.586V7A1,1,0,0,0,12,6Z M23.812,10.132A12,12,0,0,0,3.578,3.415V1a1,1,0,0,0-2,0V5a2,2,0,0,0,2,2h4a1,1,0,0,0,0-2H4.827a9.99,9.99,0,1,1-2.835,7.878A.982.982,0,0,0,1,12a1.007,1.007,0,0,0-1,1.1,12,12,0,1,0,23.808-2.969Z" />
                                </g>
                            </svg>
                        </div>
                        <div class="pl-2">
                            <p>{{ \Carbon\Carbon::parse($cornerpost->published_at)->diffForHumans() }} yayınlandı</p>
                        </div>
                    </div>
                </div>

                <div class="mb-4 text-slate-500">
                </div>

                <div class="mb-4 flex items-center justify-between">

                    <div class="flex gap-2 items-center">
                        <div>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    version="1.1" id="tagdescription" viewBox="-134.34 -134.34 500.30 500.30"
                                    enable-background="new 0 0 231.6208 232.1921" xml:space="preserve" width="30px"
                                    height="30px" fill="#000000" stroke="#000000" stroke-width="0.002316208">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <g>
                                            <path fill="#5CB0FF"
                                                d="M137.5664,14.8503L9.6562,142.7605l79.1953,79.1992L216.7656,94.0456 c-8.8516-14.043-6.9453-32.6562,5.0234-44.6211L182.1914,9.8269C170.2188,21.7956,151.6055,23.7058,137.5664,14.8503z M51.5977,129.1081l79.6797-79.6836l5.6562,5.6562l-79.6797,79.6836L51.5977,129.1081z M79.8789,157.3933l-5.6562-5.6562 l54.2266-54.2305l5.6562,5.6562L79.8789,157.3933z M102.5078,180.0183l-5.6562-5.6562l68.3672-68.3711l5.6562,5.6562 L102.5078,180.0183z M195.3633,52.2527c0,4.2734-1.6641,8.2891-4.6875,11.3125c-3.1211,3.1211-7.2188,4.6797-11.3125,4.6797 c-4.0977,0-8.1953-1.5586-11.3164-4.6797c-6.2344-6.2422-6.2344-16.3906,0-22.625c6.2422-6.2383,16.3867-6.2461,22.6289,0 C193.6992,43.9597,195.3633,47.9753,195.3633,52.2527z">
                                            </path>
                                            <path fill="#1C71DA"
                                                d="M230.4492,46.7722L184.8438,1.1667c-0.8125-0.8125-1.9258-1.2031-3.0703-1.1641 c-1.1445,0.0703-2.2031,0.625-2.9102,1.5273c-0.7148,0.9141-1.4922,1.8008-2.3281,2.6406 c-9.9727,9.9688-25.8594,10.9609-36.9688,2.3242c-1.5898-1.2383-3.8555-1.1055-5.2852,0.3281L1.1719,139.9324 c-1.5625,1.5625-1.5625,4.0938,0,5.6562l84.8516,84.8555c0.75,0.75,1.7656,1.1719,2.8281,1.1719s2.0781-0.4219,2.8281-1.1719 L224.793,97.3308c1.4258-1.4258,1.5664-3.6914,0.3281-5.2852c-8.6406-11.1055-7.6445-26.9961,2.3242-36.9648 c0.8359-0.8359,1.7148-1.6133,2.625-2.3203c0.9102-0.7031,1.4688-1.7617,1.543-2.9102 C231.6836,48.7058,231.2617,47.5847,230.4492,46.7722z M216.7656,94.0456L88.8516,221.9597L9.6562,142.7605L137.5664,14.8503 c14.0391,8.8555,32.6523,6.9453,44.625-5.0234l39.5977,39.5977C209.8203,61.3894,207.9141,80.0027,216.7656,94.0456z">
                                            </path>
                                            <path fill="#1C71DA"
                                                d="M168.0469,40.9402c-6.2344,6.2344-6.2344,16.3828,0,22.625c3.1211,3.1211,7.2188,4.6797,11.3164,4.6797 c4.0938,0,8.1914-1.5586,11.3125-4.6797c3.0234-3.0234,4.6875-7.0391,4.6875-11.3125c0-4.2773-1.6641-8.293-4.6875-11.3125 C184.4336,34.6941,174.2891,34.7019,168.0469,40.9402z M187.3633,52.2527c0,2.1367-0.832,4.1445-2.3438,5.6562 c-3.1172,3.1172-8.1914,3.1172-11.3164,0c-3.1172-3.1211-3.1172-8.1953,0-11.3125c3.1172-3.1211,8.1992-3.1172,11.3164,0 C186.5312,48.1081,187.3633,50.1159,187.3633,52.2527z">
                                            </path>
                                            <rect x="37.9222" y="88.0949"
                                                transform="matrix(0.7071 -0.7071 0.7071 0.7071 -37.5108 93.6329)"
                                                fill="#1C71DA" width="112.6869" height="7.9991"></rect>
                                            <rect x="65.8187" y="123.4504"
                                                transform="matrix(0.7071 -0.7071 0.7071 0.7071 -59.6124 110.9902)"
                                                fill="#1C71DA" width="76.6907" height="7.9991"></rect>
                                            <rect x="85.519" y="139.0051"
                                                transform="matrix(0.7071 -0.7071 0.7071 0.7071 -61.9119 136.5407)"
                                                fill="#1C71DA" width="96.6886" height="7.9991"></rect>
                                        </g>
                                        <path fill="#FF5D5D"
                                            d="M40.252,68.1921c-1.0234,0-2.0479-0.3906-2.8281-1.1719c-1.5625-1.5615-1.5625-4.0947,0-5.6562 l14.1426-14.1426c1.5605-1.5625,4.0957-1.5625,5.6562,0c1.5625,1.5615,1.5625,4.0947,0,5.6562L43.0801,67.0202 C42.2998,67.8015,41.2754,68.1921,40.252,68.1921z">
                                        </path>
                                        <path fill="#FF5D5D"
                                            d="M54.3945,68.1921c-1.0234,0-2.0469-0.3906-2.8281-1.1719L37.4238,52.8786 c-1.5625-1.5615-1.5625-4.0947,0-5.6562c1.5605-1.5625,4.0938-1.5625,5.6562,0L57.2227,61.364c1.5625,1.5615,1.5625,4.0947,0,5.6562 C56.4424,67.8015,55.418,68.1921,54.3945,68.1921z">
                                        </path>
                                        <path fill="#00D40B"
                                            d="M46.252,232.1921c-7.7197,0-14-6.2803-14-14s6.2803-14,14-14s14,6.2803,14,14 S53.9717,232.1921,46.252,232.1921z M46.252,212.1921c-3.3086,0-6,2.6914-6,6s2.6914,6,6,6s6-2.6914,6-6 S49.5605,212.1921,46.252,212.1921z">
                                        </path>
                                        <path fill="#FFC504"
                                            d="M211.5664,178.8191c-1.0234,0-2.0469-0.3906-2.8281-1.1719l-11.3145-11.3135 c-0.75-0.75-1.1719-1.7676-1.1719-2.8281s0.4219-2.0781,1.1719-2.8281l11.3145-11.3135c1.5625-1.5625,4.0938-1.5625,5.6562,0 l11.3135,11.3135c1.5625,1.5615,1.5625,4.0947,0,5.6562l-11.3135,11.3135C213.6143,178.4285,212.5898,178.8191,211.5664,178.8191z M205.9092,163.5056l5.6572,5.6572l5.6562-5.6572l-5.6562-5.6572L205.9092,163.5056z">
                                        </path>
                                    </g>
                                </svg>
                            </span>
                        </div>
                        <div class="grid grid-cols-2 sm:flex">
                            @foreach ($cornerpost->tag as $tag)
                                <span
                                    class="rounded-md border w-fit border-blue-300 px-1 mx-1 text-sm text-slate-500 font-semibold shadow-sm italic">
                                    {{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <button
                            class="right-0 rounded-md border border-blue-300 px-2.5 py-1.5 text-center text-sm font-semibold shadow-sm hover:bg-blue-300"><a
                                href="#">{{ strtoupper($cornerpost->category->name) }}</a></button>
                    </div>
                </div>
                <div class="grid grid-cols-2 justify-items-stretch">
                    <div class="flex space-x-3">
                        <div class="self-center py-2 ">
                            {{-- <a class="py-2 px-5" href="{{ route('dashboard.cornerpost.update', ['id' => $cornerpost->id]) }}">Güncelle</a> --}}
                            <x-a-tag :href="$href='dashboard.cornerpost.update'" :key="$key='cornerpost'" :data="$data=$cornerpost" :value="$value='Düzenle'"/>
                        </div>
                        <div class="py-1">
                            <form class="m-0 p-0"
                                action="{{ route('dashboard.cornerpost.delete') }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                {{-- <button class="py-1 px-10">Sil</button> --}}
                                <input name="id" id="id" type="hidden" value="{{ $cornerpost->id }}">
                                <x-primary-button onclick="javascript: return confirm('Emin misiniz?');" class="ms-4">
                                    {{ __('Delete') }}
                                </x-primary-button>

                            </form>
                        </div>
                    </div>
                    <livewire:post-like-counter :cornerPostId="$cornerpost->id" />
                </div>

            </div>
        @endforeach
    </div>

</x-app-layout>
