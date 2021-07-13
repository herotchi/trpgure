<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Models\Scenario;
use Illuminate\Support\Facades\Auth;

class FollowExchange implements Rule
{
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
     * 参加者とシナリオ主催者が相互フォロー状態か確認するために双方のフォローを調べる
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $detail = $this->scenario->find($value);
        // 参加者がシナリオ主催者にフォローされているか確認
        $followingCount = $detail->user->followings->where('friend_code', Auth::user()->friend_code)->count();
        // 参加者がシナリオ主催者をフォローしているか確認
        $followedCount = $detail->user->followeds->where('friend_code', Auth::user()->friend_code)->count();

        // お互いにフォローしていた場合、相互フォロー状態だと判断する
        if ($followingCount === 1 && $followedCount === 1) {
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
        return '相互フォローになっていないユーザーが主催しているシナリオには参加できません。';
    }
}
