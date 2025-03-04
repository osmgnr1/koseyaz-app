<div class="grid grid-cols-2 gap-5">
    <select wire:model.live="selectedTags" multiple class="h-60">
        <option disabled>2-5 arasında etiket seçiniz</option>
        @foreach ($tags as $tag)
            <option value="{{ $tag }}">{{ $tag->name }}</option>
        @endforeach
    </select>
    <div>
            @if (count($selectedTags)<2)
                <p class="text-red-700">En az 2 kelime seçiniz</p>
            @elseif (count($selectedTags)>5)
                <p class="text-red-700">En fazla 5 kelime seçiniz</p>
            @endif

            @foreach ($selectedTags as $item)
                <p>{{ json_decode($item, true)["name"] }}</p>
            @endforeach
            {{-- {{ $count = count($selectedTags) }} --}}
    </div>
</div>
