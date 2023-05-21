<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use JetBrains\PhpStorm\NoReturn;

class Uppercase implements ValidationRule
{
    public function __construct() {

    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        if (strtoupper($value) !== $value) {
            $fail(':attribute must be uppercase.');
        }
    }

}
