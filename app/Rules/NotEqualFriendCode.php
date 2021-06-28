<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use Illuminate\Support\Facades\Auth;

class NotEqualFriendCode implements Rule
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
        // 自分自身をフォロー、解除しようとした場合、エラーにする
        if (Auth::user()->friend_code === $value) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '自分自身は操作できません。';
    }
}
