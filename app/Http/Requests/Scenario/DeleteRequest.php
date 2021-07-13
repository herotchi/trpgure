<?php

namespace App\Http\Requests\Scenario;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class DeleteRequest extends FormRequest
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
                Rule::exists('scenarios')->where('user_friend_code', Auth::user()->friend_code),
            ],
        ];
    }


    // シナリオIDに入力エラーがあった場合は管理画面にリダイレクトする
    public function withValidator(\Illuminate\Validation\Validator $validator)
    {
        $validator->after(function ($validator) {
            $errors = $validator->errors();
            if ($errors->any()) {
                $this->redirectRoute = 'scenarios.manage';
                session()->flash('msg_failure', '不正な値が入力されました。');
            }
        });
    }
}
