<?php

namespace App\Http\Requests\Scenario;

use Illuminate\Foundation\Http\FormRequest;

use App\Consts\ScenarioConsts;
use App\Consts\UserConsts;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Rules\AlphaNumJp;
use Illuminate\Support\Arr;

class ListRequest extends FormRequest
{
    protected $alphaNumJp;

    private $forms = [
        'title',
        'friend_code',
        'genre'
    ];

    public function __construct(AlphaNumJp $alphaNumJp)
    {
        $this->alphaNumJp = $alphaNumJp;
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
            'title' => 'bail|nullable|string|max:' . ScenarioConsts::TITLE_LENGTH_MAX,
            'friend_code' => [
                'bail', 
                'nullable', 
                'string', 
                'size:' . UserConsts::FRIEND_CODE_LENGTH,
                $this->alphaNumJp,
                'exists:users,friend_code', 
                Rule::exists('friends', 'followed_friend_code')->where('following_friend_code', Auth::user()->friend_code)
            ],
            'genre' => [
                'bail', 'nullable', 'integer', Rule::in(array_keys(ScenarioConsts::GENRE_LIST))
            ],
        ];
    }


    public function validated()
    {
        $data = parent::validated();

        foreach ($this->forms as $value) {
            if(!Arr::exists($data, $value)) {
                $data[$value] = null;
            }
        }

        return $data;
    }

}
