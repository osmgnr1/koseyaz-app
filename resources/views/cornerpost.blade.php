<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Köşe yazısı faydalı bilgiler') }}
        </h2>

    </x-slot>


    <div class="pb-10 mb-10 w-full sm:w-3/4 justify-self-center px-10 mt-5 border-2 border-slate-400 rounded-xl">

        {{-- Tanımı --}}
        <div class="py-6">


            {{-- <h2 class="py-2 font-semibold text-lg text-gray-800 leading-tight">Köşe Yazısı Tanımı</h2> --}}
            <x-h-tag :value="$value='Köşe Yazısı Tanımı'"></x-h-tag>

            <x-p-tag :value="$value =
                'Köşe yazısı veya fıkra; bir yazarın ve herhangi bir konu veya günlük olaylar hakkındaki görüşlerini, düşüncelerini ayrıntılara inmeden anlattığı gazete ve dergilerde yayımlanan kısa fikir yazılarının genel adıdır. Fıkralar, gazete ve dergilerin belli sütun veya köşelerinde yayımlanır. Yazarın, gündelik olayları, özel bir görüşle, güzel bir üslupla, kanıtlama gereği duymadan yazdığı kısa, günübirlik yazılardır.'"></x-p-tag>

            <x-p-tag :value="$value =
                'Köşe yazıları, bir yazarın günlük olaylara ya da ülke ve toplum sorunlarına ait her hangi bir konu üzerinde kişisel görüş ve düşüncelerini içermekle birlkte, akıcı bir dil kullanarak okuyuculara sunulma sürecidir. Bir başka ifadeyle; gazete ya da dergilerin belirli yerlerinde yayımlanan, güncel, siyasal, toplumsal sorunları kişisel görüşle ele alıp işleyen yazılara fıkra (köşe yazısı) denir.'"></x-p-tag>

            <x-p-tag :value="$value =
                'Fıkraların amacı, siyasi, kültürel, ekonomik, toplumsal vb. konuları çok defa eleştirel bir bakış açısıyla anlatarak kamuoyunu yönlendirmektir. Okuyuculara gündelik olayları derleyip bir bilgi paketi sunmaktır. Fıkralarda kesin olmaktan ziyade güzel, hoş sonuçlara varmaya; canlı, ilgi çekici olmaya özen gösterilmelidir. Yazar kendi duygu ve düşüncelerini en başarılı şekilde yansıtarak okuyucu ile arasında sıkı bir bağ kurar. '"></x-p-tag>
            <blockquote class="pb-2 text-sm sm:text-base text-gray-600"><a
                    href="https://tr.wikipedia.org/wiki/K%C3%B6%C5%9Fe_yaz%C4%B1s%C4%B1" target="_blank"><q
                        cite=""><em>Wikipedia: Köşe yazısı</em></q></a></blockquote>

        </div>
        {{-- Tanımı --}}

        {{-- Özellikleri --}}

        <div class="pb-6">

            {{-- <h2 class="py-2 font-semibold text-lg text-gray-800 leading-tight">Özellikleri</h2> --}}
            <x-h-tag :value="$value='Özellikleri'"></x-h-tag>

            <x-p-tag :value="$value =
                'Köşe yazıları; güncel, gündelik, aktüel olaylar gözlenerek oluşturulurlar. Gazete ve dergi sayfalarının belli bir kısmında yayımlanan bu yazıların bir sanat eseri değeri yoktur. Okunduktan sonra yazarın bilgileri kullanmadaki derinliği, bilgisi ve ön hazırlığı köşe yazısında kendini belli ederek yazının değerini ortaya koyar. Yazar, değindiği konuyu kendi yorumları ile değerlendirir. Yazar değerlendirmelerinde kanıtlama yoluna gitmez. anlatım şekli olarak yalın bir dil seçer. Yazar, çeşitli konulara değinebilir. Enflasyon, seçimler, terörle ilgili olaylar, erozyon, çevre kirliliği, dünyanın herhangi bir yerindeki savaş, magazin, herhangi bir yarışma, yemek ve gurme, toplumsal ve kültürel gibi konular köşe yazısı konusu olabilir. Köşe yazısında bir düşünce yapısı ile birlikte yazı oluşturulur.'"></x-p-tag>

            <ul class="px-8 list-disc">
                <x-li-tag :sentence="$sentence = 'Gerçek olaylar veya düşüncelerle ilgili konular işlenir.'" />
                <x-li-tag :sentence="$sentence = 'Düşünce ön plandadır.'" />
                <x-li-tag :sentence="$sentence = 'Konular çok değişik açılardan ele alınmadan, ayrıntılara inilmeden işlenir.'" />
                <x-li-tag :sentence="$sentence = 'Yazılanlara okuyucuyu inandırma zorunluluğu yoktur.'" />
                <x-li-tag :sentence="$sentence = 'Yazılanlar okuyucunun ilgisini çekmelidir.'" />
                <x-li-tag :sentence="$sentence = 'Açık, sade ve akıcı bir dil kullanılmalıdır.'" />
                <x-li-tag :sentence="$sentence =
                    'Konular okuyucuda merak uyandırmalı, aynı zamanda da eğitici ve bilgilendirici olmalıdır.'" />
                <x-li-tag :sentence="$sentence = 'Genellikle kısa ve öz bir dille yazılırlar.'" />
            </ul>

        </div>

        {{-- Özellikleri --}}

        {{-- Köşe yazısı ve makale arasındaki fark --}}
        <div class="pb-6">
            {{-- <h2 class="py-2 font-semibold text-lg text-gray-800 leading-tight">Köşe yazısı &lpar;fıkra&rpar; ve makale arasındaki farklar</h2> --}}
                <x-h-tag :value="$value='Köşe yazısı (fıkra) ve makale arasındaki farklar'"></x-h-tag>

            <ul class="px-8 list-disc">
                <x-li-tag :sentence="$sentence = 'Köşe yazıları, makalelere göre daha uzun bir yazı türüdür.'" />
                <x-li-tag :sentence="$sentence =
                    'Yazar makalede görüşlerini kanıtlama amacı taşır. Ancak köşe yazılarında böyle bir zorunluluk yoktur.'" />
                <x-li-tag :sentence="$sentence =
                    'Köşe yazısı yazımında bilimsel makalelerdeki gibi herhangi bir ciddiyet görülmez. Makalede nesnel nitelikler ağır basarken, köşe yazılarında öznel nitelikler ağır basar. Fıkrada yer yer esprili, hoşa giden bir anlatım öne çıkar.'" />
                <x-li-tag :sentence="$sentence = 'Köşe yazılarında hoşa giden, esprili bir anlatım ön plana çıkar.'" />
                <x-li-tag :sentence="$sentence =
                    'Makale yazmak uzmanlık isteyen bir yazı türüdür. Makalede belli alanlarda bilimsel olarak yetkinliklere sahip olmayı gerektirir. Ancak köşe yazısı yazmak için herhangi bir bilimsel yetkinlik aranmamaktadır. Aynı konuyu farklı yazarlar değişik bakış açılarıyla ortaya koyabilirler.'" />
            </ul>
        </div>
        {{-- Köşe yazısı ve makale arasındaki fark --}}


        {{-- Köşe yazısı yazım planı --}}
        <div class="pb-4">

            {{-- <h2 class="py-2 font-semibold text-lg text-gray-800 leading-tight">Köşe yazısında yazım planı</h2> --}}
            <x-h-tag :value="$value='Köşe yazısında yazım planı'"></x-h-tag>


            <x-p-tag :value="$value = 'Köşe yazısında öncelikle konu hakkında tanıtıcı bilgiler verilir. Tartışılacak konunun girişi yapılır.
                                                                Giriş yapılarak konu tanıtılır, açıklanır, sınırları belirlenir. Köşe yazısının amacı politik, ekonomik,
                                                                sosyal, kültürel, vb. bir görüş ortaya koymak ve bu görüşü etkili bir biçimde savunmaktır. Bu amaçla
                                                                yazar, ortaya attığı görüşü destekleyecek bir ortam oluşturur. Belgeler ve/veya örnekler sunar,
                                                                Gerekirse etkili kişilerin görüşlerinden alıntılar yapar. Veya gerekirse görüşünü bilimsel gerçeklere
                                                                dayandırarak iddiasını destekler.'"></x-p-tag>

            <x-p-tag :value="$value = 'Yazar konuya nokta koymak için kendi öznel görüşünü destekliyici kararını açıklar. diğer bir deyişle
                                                                görüşünü bir sonuca bağlar. Dolayısıyla, sonuç ya da karar yazarın görüşleri ile uyum içerisinde
                                                                olmalıdır. Yazıda, gerekirse tartışılan veya sunulan konuya ilişkin, yazarın görüşlerini destekleyici
                                                                nitelikte öneriler sunulabilir. Öneri yerine, okuyucuların düşünce dünyasını destekleyici mesaj da
                                                                iletebilir. Bu anlamda, köşe yazılarındaki en çarpıcı olan kısım genellikle mesaj kısmıdır.'"></x-p-tag>

            <x-p-tag :value="$value = 'Köşe yazılarında genel olarak aşağıdaki süreç takip edilebilir.'"></x-p-tag>

            <blockquote class="pb-2 text-sm sm:text-base text-gray-600">
                <a href="https://www.turkedebiyati.org/fikra/" target="_blank"><q cite=""><i>TurkEdebiyatı.org:
                            Fıkra Yazı Türü ve Özellikleri</i></q></a>
            </blockquote>

            <ul class="px-8 list-decimal marker:font-bold">
                <x-li-tag :sentence="$sentence =
                    'Konu, okuyucunun duygu, düşünce ve zekâsını okşayan günlük olaylardan seçilmelidir.'" />
                <x-li-tag :sentence="$sentence = 'Yazının plânı hazırlanmalıdır.'" />
                <x-li-tag :sentence="$sentence = 'Gerekiyorsa, başkalarına ait deyişler saptanmalıdır.'" />
                <x-li-tag :sentence="$sentence = 'Anlatımın açık, sade olmasına dikkat edilmelidir.'" />
                <x-li-tag :sentence="$sentence = 'Yazı, gereksiz yere uzatılmamalı, elden geldiğince kısa tutulmalıdır.'" />
            </ul>

        </div>
        {{-- Köşe yazısı yazım planı --}}

        @guest

            <div class="pb-6 flex sm:flex-row flex-col gap-2">

                {{-- <p class="font-semibold text-base text-gray-600 leading-tight">Üye olarak köşe yazısı yazmaya başlayabilirsin.</p> --}}
                <x-p-tag :value="$value='Üye olarak köşe yazısı yazmaya başlayabilirsin.'"></x-p-tag>
                <span><x-a-tag :href="$href = 'register'" :value="$value = 'Register'" /></span>

            </div>
        @endguest

    </div>

</x-app-layout>
{{-- @endsection --}}
