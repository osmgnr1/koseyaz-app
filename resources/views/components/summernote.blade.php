@props(['body'])
<div class="text-xs sm:text-base">

    @push('link')
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-tr-TR.js"></script>
    @endpush
    <div class="text-xs sm:text-base py-4 px-6">
        <ol class="list-disc">
            @if ($update === 'y')
                <li class="text-red-400 italic font-bold">
                    {{ __('Kaydet butonu aktif etmek için metin içerisinde en az bir karakterlik değişiklik yapınız..!') }}
                </li>
            @endif
            <li> {{ __('Yazınızı iletmek için en az 1.000 (Bin) karakter (boşluk dahil) girmelisiniz!') }} </li>
            <li>{{ __('En fazla 5.000 (Beş bin) karakter (boşluk dahil) girmelisiniz!') }}</li>
            <li>{{ __('Etik olmayan, hakaret, küfür ve argo içermeyen kelimeler kullanılmasına özen gösteriniz!') }}
            </li>
            <li><b>{{ __('Okuyanınız bol olsun..!') }}</b></li>
        </ol>
    </div>
    <div class="flex justify-between">
        <label for="body" class="text-xs sm:text-base font-bold">{{ __('Script') }}</label>
        <p class="text-xs sm:text-base"><span id="charCountNoSpace" class="font-extrabold"> 5000 </span> karakter (boşluk
            dahil!)</p>
    </div>
    <textarea id="summernote" class="summernote form-control" name="body">{{ old('body') ? old('body') : $body }}</textarea>

    @push('scripts')
        <script>
            document.getElementById("btnSubmitCornerPost").disabled = true;
            document.getElementById("btnSubmitCornerPost").style.backgroundColor = "rgb(107 114 128)";
            $('#summernote').summernote({

                placeholder: "{{ __('Yazmaya buradan başlayın. Yazınızı farklı bir dokümanda hazırlayarak kopyala yapıştır yapabilirsiniz. ') }}",
                tabsize: 2,
                height: 500,
                toolbar: [
                    // ['cleaner', ['cleaner']], // The Button
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'italic', 'clear']],
                    ['para', ['ul', 'ol']],
                    // ['table', ['table']],
                    ['insert', ['picture', 'link']],
                    ['view', ['codeview', 'help']]
                ],

                lang: "tr-TR",
                styleTags: ['p', 'blockquote', 'h2', 'h3', 'h4'],
                code: 'çÇĞğÖöŞş',
                maximumImageFileSize: 500 * 1024, // 500 KB


                callbacks: {
                    onChange: function(contents, $editable) {
                        $('.note-status-output').html('');
                        var regex = /\s+/gi;
                        var limit = 5000;
                        var minLimit = 1000;
                        var characters = $(".note-editable").text();
                        var totalChar = characters.length;

                        // var totalChar = characters.replace(regex, '').length;

                        if (totalChar > limit) {
                            // return false;
                            $('.note-status-output').html(
                                '<div class="alert alert-danger">' +
                                'En fazla 5000 karakter sayısı aşıldı!' +
                                '</div>'
                            );

                            document.getElementById("btnSubmitCornerPost").disabled = true;
                            document.getElementById("btnSubmitCornerPost").style.backgroundColor =
                                "rgb(107 114 128)";
                        }

                        if (totalChar >= minLimit) {
                            document.getElementById("btnSubmitCornerPost").disabled = false;
                            document.getElementById("btnSubmitCornerPost").style.backgroundColor = "rgb(31 41 55)";

                            $('.note-status-output').html(
                                '<div class="alert alert-info">' +
                                'En az 1000 karakter girildi. Yazınızı ilerletebilirsiniz veya iletebilirsiniz!' +
                                '</div>'
                            );

                        } else {

                            document.getElementById("btnSubmitCornerPost").disabled = true;
                            document.getElementById("btnSubmitCornerPost").style.backgroundColor =
                                "rgb(107 114 128)";
                        }

                    },

                    onKeydown: function(e) {
                        var regex = /\s+/gi;
                        var characters = $(".note-editable").text();
                        var totalChar = characters.length;
                        // var totalChar = characters.replace(regex, '').length;

                        var limit = 5000;

                        // var t = e.currentTarget.innerText;
                        if (totalChar >= limit) {
                            //delete keys, arrow keys, copy, cut, select all
                            if (e.keyCode != 8 && !(e.keyCode >= 37 && e.keyCode <= 40) && e.keyCode != 46 && !(e
                                    .keyCode == 88 && e.ctrlKey) && !(e.keyCode == 67 && e.ctrlKey) && !(e
                                    .keyCode == 65 && e.ctrlKey))
                                e.preventDefault();
                        }
                    },
                    onKeyup: function(e) {
                        var regex = /\s+/gi;
                        var limit = 5000;
                        var characters = $(".note-editable").text();
                        var totalChar = characters.length;
                        // var totalChar = characters.replace(regex, '').length;

                        $('#charCountNoSpace').text(limit - totalChar);

                    },

                    onPaste: function(e) {
                        var regex = /\s+/gi;
                        var limit = 5000;
                        var characters = $(".note-editable").text();
                        var totalChar = characters.length;
                        // var totalChar = characters.replace(regex, '').length;

                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData(
                            'Text');
                        e.preventDefault();

                        var maxPaste = bufferText.length;

                        if (totalChar + maxPaste > limit) {
                            maxPaste = limit - totalChar;
                        }

                        if (maxPaste > 0) {

                            document.execCommand('insertText', false, bufferText.substring(0, maxPaste));
                        }
                        $('#charCountNoSpace').text(limit - totalChar);
                    }


                }

            });

            //https://stackoverflow.com/questions/27527989/setting-max-length-in-summernote
            //https://jsfiddle.net/JLtCN/3/ Example
            //https://deepumohan.com/projects/word-count/
        </script>
    @endpush

</div>
