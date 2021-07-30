<?php

namespace App\Http\Requests\Scenario;

use Illuminate\Foundation\Http\FormRequest;

use App\Consts\ScenarioConsts;
use App\Consts\CharacterConsts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Rules\FollowExchange;
use DateTime;

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
        //$today = new Datetime();

        return [
            //
            'id' => [
                'bail',
                'required',
                'integer',
                // 公開中で募集開始日が現在と同じか過去かつ募集終了日が現在と同じか未来のセッションのみ
                Rule::exists('scenarios', 'id')->where('public_flg', ScenarioConsts::PUBLIC_FLG_PUBLIC)->where(function ($query) {
                    $today = new Datetime();
                    return $query->where('part_period_start', '<=', $today->format('Y-m-d'))->where('part_period_end', '>=', $today->format('Y-m-d'));
                }),
                // ユーザーとセッション募集者が相互フォロー状態
                $this->followExchange,
                // まだ参加していない
                Rule::unique('characters', 'scenario_id')->where('user_friend_code', Auth::user()->friend_code),
            ],
            'name' => 'bail|required|string|min:' . CharacterConsts::NAME_LENGTH_MIN . '|max:' . CharacterConsts::NAME_LENGTH_MAX,
            'service' => ['bail', 'nullable', 'required_with:character_sheet', 'integer', Rule::in(array_keys(CharacterConsts::SERVICE_DOMAIN_LIST))],
            'character_sheet' => 'bail|nullable|required_with:service|string|min:' . CharacterConsts::CHARACTER_SHEET_LENGTH_MIN . '|max:' . CharacterConsts::CHARACTER_SHEET_LENGTH_MAX,
        ];
    }


    // シナリオIDに入力エラーがあった場合は一覧画面にリダイレクトする
    public function withValidator(\Illuminate\Validation\Validator $validator)
    {
        $validator->after(function ($validator) {
            $errors = $validator->errors();
            if ($errors->has('id')) {
                $this->redirectRoute = 'scenarios.list';
                session()->flash('msg_failure', '不正な値が入力されました。');
            }
        });
    }
}
