<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Models\Scenario;
use Illuminate\Support\Facades\Auth;

class Followed implements Rule
{
    protected $scenario;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Scenario $scenario)
    {
        //
        $this->scenario = $scenario;
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
        // 閲覧者がセッション募集者をフォローしているか確認
        $detail = $this->scenario->find($value);
        $count = $detail->user->followeds->where('friend_code', Auth::user()->friend_code)->count();

        if ($count === 1) {
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
        return 'フォローしていないユーザーが募集するセッションを閲覧することはできません。';
    }
}
