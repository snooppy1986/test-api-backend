<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $pattern = "/^[\+]{0,1}380([0-9]{9})$/";

        if(!preg_match(pattern: $pattern, subject: $value)){
            $fail('The :attribute field format is invalid.');
        }
    }
}
