@props(['tagsdb', 'tagsdbup', 'cornerpost'])

<div>
    @push('select2links')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endpush


    <div wire:ignore>
        <div  class="flex items-center justify-between sm:justify-start space-x-5 relative" wire:ignore>
            <label class="font-bold text-xs sm:text-base">Etiket Ekle <span></span></label>
            <select id="select2-dropdown" name="tags[]" multiple
                class="h-full rounded-r border-t border-r border-b block w-full sm:w-1/2 bg-white border-gray-300 text-gray-700 py-2 px-4 pr-8 leading-tight focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none">
                <option value="" disabled="disabled">Select Option</option>

                @if (isset($tagsdb))
                    @foreach ($tagsdb as $tag)
                        <option value="{{ $tag->id }}" {{ collect(old('tags'))->contains($tag->id) ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                @else
                    @foreach ($tagsdbup as $tag)
                        <option value="{{ $tag->id }}" {{ $cornerpost->tag->contains($tag->id) ? 'selected' : '' }}>
                            {{ $tag->name }}</option>
                    @endforeach
                @endif

            </select>
        </div>
    </div>



    @push('select2scripts')
        <script>
            $(document).ready(function() {
                $('#select2-dropdown').select2({
                    placeholder: "Etiketleri seç",
                    multiple: true,
                    theme: "default",
                    language: {
                        noResults: function() {
                            return 'Sonuç bulunamadı';
                        },

                        maximumSelected: function(args) {
                            var message = 'Sadece ' + args.maximum + ' seçim yapabilirsiniz';
                            return message;
                        },
                    },
                    allowClear: true,
                    tags: true,
                    tokenSeparators: [',', ' '],
                    maximumSelectionLength: 5,

                    createTag: function(params) {
                        var term = $.trim(params.term);

                        if (term.match(/^[a-zA-ZŞşÇçÖöÜüĞğİiı]+$/g)) {

                            return {
                                id: term,
                                text: term,
                                newTag: true // add additional parameters
                            }

                        }

                        return null;

                    },

                });
                $('#select2-dropdown').on('change', function(e) {
                    var data = $('#select2-dropdown').select2("val");
                    let closeButton = $('.select2-selection__clear')[0];
                    if (typeof(closeButton) != 'undefined') {
                        if (data.length <= 0) {
                            $('.select2-selection__clear')[0].children[0].innerHTML = '';
                        } else {
                            $('.select2-selection__clear')[0].children[0].innerHTML = 'x';
                        }
                    }

                });

            });
        </script>
    @endpush

</div>
