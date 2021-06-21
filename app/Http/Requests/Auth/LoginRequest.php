<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

use App\Consts\AuthConsts;

class LoginRequest extends FormRequest
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
            'login_id' => 'required|max:' . AuthConsts::LOGIN_ID_LENGTH_MAX,
            'password' => 'required|max:' . AuthConsts::PASSWORD_LENGTH_MAX,
        ];
    }
}
