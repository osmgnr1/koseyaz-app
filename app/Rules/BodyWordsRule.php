<?php

namespace App\Rules;

use Closure;
use DOMDocument;
use Illuminate\Contracts\Validation\ValidationRule;

use function PHPSTORM_META\type;

class BodyWordsRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // dd($value);
        $dom = new DOMDocument();
        $contentType = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
        libxml_use_internal_errors(true);// In many cases it is advisable to use libxml_use_internal_errors(true); before $dom->loadHTML($content);

        if (strpos($value,$contentType)) {
            $dom->loadHTML($value,9); // If it comes from update
        }

        $dom->loadHTML($contentType.$value,9); // if it comes from create

        // $before = array('ı', 'ğ', 'ü', 'ş', 'ö', 'ç', 'İ', 'Ğ', 'Ü', 'Ö', 'Ç', 'Ş'); // , '\'', '""'
        // $after   = array('i', 'g', 'u', 's', 'o', 'c', 'i', 'g', 'u', 'o', 'c', 's'); // , '', ''

        // $pattern = "/([\t\s,])/";

        $textContent = [];

        $elements = ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'li'];

        foreach ($elements as $element) {

            $node_array = [];
            $nodes = $dom->getElementsByTagName($element);

            if (!$nodes) {
                continue;
            }

            foreach ($nodes as $node) {

                if (empty($node->textContent)) {
                    continue;
                }

                if ($node->hasChildNodes()){

                    foreach ($node as $nod) {

                        if (empty($nod->textContent)) {
                            continue;
                        }

                        // $node_array = preg_split("/[,;| ]/", $nod->textContent, -1,PREG_SPLIT_NO_EMPTY);
                        $node_array = mb_str_split(str_replace(['\n','\r'], '', $nod->textContent,));

                        $textContent = array_merge($textContent, $node_array);
                        $node_array = [];
                    }
                }

                // $node_array = preg_split("/[,;| ]/", $node->textContent, -1,PREG_SPLIT_NO_EMPTY);
                $node_array = mb_str_split(str_replace(['\n','\r'], '', $node->textContent,));
                $textContent = array_merge($textContent, $node_array);

            }
        }

        $count = count($textContent);

        if ($count < 1000) {
            $fail("Metin en az 1000 karakter içermelidir. Karakter sayısı: $count");
        }elseif (5000 < $count) {
            $fail("Metin en fazla 5000 karakter içermelidir. Karakter sayısı: $count");
        }

    }

}
