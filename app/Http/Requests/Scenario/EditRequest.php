<?php

namespace App\Http\Requests\Scenario;

use Illuminate\Foundation\Http\FormRequest;

use App\Consts\ScenarioConsts;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

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
            'id' => ['bail', 'required', 'integer', Rule::exists('scenarios')->where('user_friend_code', Auth::user()->friend_code)],
            'title' => 'bail|required|string|min:' . ScenarioConsts::TITLE_LENGTH_MIN . '|max:' . ScenarioConsts::TITLE_LENGTH_MAX,
            'summary' => 'bail|nullable|string|max:' . ScenarioConsts::SUMMARY_LENGTH_MAX,
            'genre' => ['bail', 'required', 'integer', Rule::in(array_keys(ScenarioConsts::GENRE_LIST))],
            'platform' => ['bail', 'required', 'integer', Rule::in(array_keys(ScenarioConsts::PLATFORM_LIST))],
            'rec_number_min' => ['bail', 'required', 'integer', Rule::in(ScenarioConsts::REC_NUMBER_LIST)],
            'rec_number_max' => ['bail', 'required', 'integer', Rule::in(ScenarioConsts::REC_NUMBER_LIST), 'gte:rec_number_min'],
            'part_period_start' => 'bail|required|date|date_format:Y/m/d|after_or_equal:2019/01/01|before_or_equal:2037/12/31',
            'part_period_end' => 'bail|required|date|date_format:Y/m/d|after_or_equal:2019/01/01|before_or_equal:2037/12/31|after_or_equal:part_period_start',
            'rec_skill' => 'bail|nullable|string|max:' . ScenarioConsts::REC_SKILL_LENGTH_MAX,
            'caution' => 'bail|nullable|string|max:' . ScenarioConsts::CAUTION_LENGTH_MAX,
            'gm_memo' => 'bail|nullable|string|max:' . ScenarioConsts::GM_MEMO_LENGTH_MAX,
            'public_flg' => ['bail', 'required', 'integer', Rule::in(array_keys(ScenarioConsts::PUBLIC_FLG_LIST))],
        ];
    }


    // シナリオIDに入力エラーがあった場合は一覧画面にリダイレクトする
    public function withValidator(\Illuminate\Validation\Validator $validator)
    {
        $validator->after(function ($validator) {
            $errors = $validator->errors();
            if ($errors->has('id')) {
                $this->redirectRoute = 'scenarios.manage';
                session()->flash('msg_failure', '不正な値が入力されました。');
            }
        });
    }
}
