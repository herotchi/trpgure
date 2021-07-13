<?php

namespace App\Http\Requests\Scenario;

use Illuminate\Foundation\Http\FormRequest;

use App\Consts\ScenarioConsts;
use App\Consts\UserConsts;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Rules\AlphaNumJp;
use Illuminate\Support\Arr;

class ManageRequest extends FormRequest
{
    protected $alphaNumJp;

    private $forms = [
        'title',
        'genre',
        'platform',
        'public_flg',
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
            'genre' => [
                'bail', 'nullable', 'integer', Rule::in(array_keys(ScenarioConsts::GENRE_LIST))
            ],
            'platform' => [
                'bail', 'nullable', 'integer', Rule::in(array_keys(ScenarioConsts::PLATFORM_LIST))
            ],
            'public_flg' => [
                'bail', 'nullable', 'integer', Rule::in(array_keys(ScenarioConsts::PUBLIC_FLG_LIST))
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
