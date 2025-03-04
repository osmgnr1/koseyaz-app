<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EntryWordsRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $count = str_word_count($value);

        if ($count < 50) {
            $fail('The :attribute must contain min 50 words.');
        }elseif (200 < $count) {
            $fail('The :attribute must contain max 200 words.');
        }

    }


}
