<?php

namespace App\Http\Requests\Character;

use Illuminate\Foundation\Http\FormRequest;

use App\Consts\CharacterConsts;
use Illuminate\Support\Arr;


class ManageRequest extends FormRequest
{
    private $forms = [
        'name',
    ];

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
            'name' => 'bail|nullable|string|max:' . CharacterConsts::NAME_LENGTH_MAX,
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
