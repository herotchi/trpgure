<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

use App\Consts\UserConsts;

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
            'user_name' => 'bail|required|string|min:' . UserConsts::USER_NAME_LENGTH_MIN . '|max:' . UserConsts::USER_NAME_LENGTH_MAX . '|unique:users,user_name',
        ];
    }
}
