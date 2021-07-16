<?php

namespace App\Http\Requests\Scenario;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Consts\ScenarioConsts;

class CancelRequest extends FormRequest
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
                // 公開中のシナリオのみ
                Rule::exists('scenarios', 'id')->where('public_flg', ScenarioConsts::PUBLIC_FLG_PUBLIC),
                // すでに参加している
                Rule::exists('characters', 'scenario_id')->where('user_friend_code', Auth::user()->friend_code),
                //$this->followExchange,
                //$this->notJoining,
            ],
        ];
    }


    // シナリオIDに入力エラーがあった場合は一覧画面にリダイレクトする
    public function withValidator(\Illuminate\Validation\Validator $validator)
    {
        $validator->after(function ($validator) {
            $errors = $validator->errors();
            if ($errors->any()) {
                $this->redirectRoute = 'scenarios.list';
                session()->flash('msg_failure', '不正な値が入力されました。');
            }
        });
    }
}
