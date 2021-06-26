<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AlphaNumJp implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        if (is_string($value) === false) {
            return false;
        }

        if (preg_match('/^[A-Za-z\d]+$/u', $value) === 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attributeはアルファベットと数字がご利用できます。';
    }
}
