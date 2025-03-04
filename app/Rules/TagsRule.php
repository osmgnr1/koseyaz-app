<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TagsRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach ($value as $key => $tag) {
            if(!$this->specialChars($tag)){
                // dd($key."  ".$tag);
                $fail('Etiketler sadece harf içermelidir...');
                continue;
            }
        }

    }


    function specialChars($str) {
        $pattern = "/"."^"."[\pL\s\-']+$/u";
        return preg_match($pattern, $str);
    }



}
