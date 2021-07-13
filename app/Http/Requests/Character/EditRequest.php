<?php

namespace App\Http\Requests\Character;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Consts\CharacterConsts;

class EditRequest extends FormRequest
{
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
            'id' => [
                'bail',
                'required',
                'integer',
                Rule::exists('characters', 'id')->where('user_friend_code', Auth::user()->friend_code),
            ],
            'name' => 'bail|required|string|min:' . CharacterConsts::NAME_LENGTH_MIN . '|max:' . CharacterConsts::NAME_LENGTH_MAX,
            'character_sheet' => 'bail|nullable|string|min:' . CharacterConsts::CHARACTER_SHEET_LENGTH_MIN . '|max:' . CharacterConsts::CHARACTER_SHEET_LENGTH_MAX,
        ];
    }


    // シナリオIDに入力エラーがあった場合は一覧画面にリダイレクトする
    public function withValidator(\Illuminate\Validation\Validator $validator)
    {
        $validator->after(function ($validator) {
            $errors = $validator->errors();
            if ($errors->has('id')) {
                $this->redirectRoute = 'characters.manage';
                session()->flash('msg_failure', '不正な値が入力されました。');
            }
        });
    }
}
