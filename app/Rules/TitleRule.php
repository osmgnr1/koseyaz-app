<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TitleRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // $count = str_word_count($value);
        $count_char= strlen($value);

        if ($count_char < 2) {
            $fail('Başlık en az 2 harf içermelidir');
        }elseif (100 < $count_char) {
            $fail('Başlık en fazla 100 karakter içermelidir');
        }
    }
}
