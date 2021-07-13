<?php

namespace App\Http\Requests\Scenario;

use Illuminate\Foundation\Http\FormRequest;

use App\Consts\ScenarioConsts;
use App\Consts\CharacterConsts;
use Illuminate\Validation\Rule;
use App\Rules\FollowExchange;

class JoinRequest extends FormRequest
{
    protected $followExchange;

    public function __construct(FollowExchange $followExchange)
    {
        $this->followExchange = $followExchange;
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
            'scenario_id' => [
                'bail', 
                'required', 
                'integer', 
                Rule::exists('scenarios', 'id')->where('public_flg', ScenarioConsts::PUBLIC_FLG_PUBLIC),
                $this->followExchange
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
            if ($errors->any()) {
                $this->redirectRoute = 'scenarios.list';
                session()->flash('msg_failure', '不正な値が入力されました。');
            }
        });
    }
}
