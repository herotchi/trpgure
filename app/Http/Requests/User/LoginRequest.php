<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

use App\Consts\UserConsts;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Rules\AlphaDashJp;

class LoginRequest extends FormRequest
{
    protected $alphaDashJp;

    public function __construct(AlphaDashJp $alphaDashJp)
    {
        $this->alphaDashJp = $alphaDashJp;
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
            'login_id'  => ['bail', 'required', 'string', $this->alphaDashJp, 'min:' . UserConsts::LOGIN_ID_LENGTH_MIN, 'max:' . UserConsts::LOGIN_ID_LENGTH_MAX, Rule::unique('users')->ignore(Auth::user()->login_id, 'login_id')],
            'password'  => ['bail', 'nullable', 'string', $this->alphaDashJp, 'min:' . UserConsts::PASSWORD_LENGTH_MIN, 'max:' . UserConsts::PASSWORD_LENGTH_MAX, 'confirmed'],
        ];
    }
}
