<?php

namespace App\Http\Requests\Friend;

use Illuminate\Foundation\Http\FormRequest;

use App\Consts\UserConsts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Rules\AlphaNumJp;
use App\Rules\NotEqualFriendCode;

class FollowRequest extends FormRequest
{
    protected $alphaNumJp;
    protected $notEqualFriendCode;

    public function __construct(AlphaNumJp $alphaNumJp, NotEqualFriendCode $notEqualFriendCode)
    {
        $this->alphaNumJp = $alphaNumJp;
        $this->notEqualFriendCode = $notEqualFriendCode;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'friend_code' => [
                'bail', 
                'required', 
                'string', 
                'size:' . UserConsts::FRIEND_CODE_LENGTH, 
                $this->alphaNumJp,
                'exists:users,friend_code',
                $this->notEqualFriendCode,
                Rule::unique('friends', 'followed_friend_code')->where('following_friend_code', Auth::user()->friend_code)
            ]
        ];
    }


    public function withValidator(\Illuminate\Validation\Validator $validator)
    {
        $validator->after(function ($validator) {
            $errors = $validator->errors();
            if ($errors->any()) {
                $this->redirectRoute = 'friends.manage';
                session()->flash('msg_failure', '不正な値が入力されました。');
            }
        });
    }
}
