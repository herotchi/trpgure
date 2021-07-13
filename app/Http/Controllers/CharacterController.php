<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Requests\Character\ManageRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Character;

class CharacterController extends Controller
{
    //
    protected $character;

    public function __construct(Character $character)
    {
        $this->character = $character;
    }


    public function manage(ManageRequest $request)
    {
        $inputs = $request->validated();
        $lists = $this->character->getManageList($inputs);

        return view('character.manage', compact(['lists', 'inputs']));
    }


    public function manage_detail($id)
    {
        var_dump(__LINE__);
        /*
        $validator = Validator::make(
            ['id' => $id],
            ['id' => [
                'bail',
                'required',
                'integer',
                Rule::exists('scenarios', 'id')->where('user_friend_code', Auth::user()->friend_code),
            ]]
        );

        if ($validator->fails()) {
            return redirect()->route('scenarios.manage')->with('msg_failure', '不正な値が入力されました。');
        }

        $detail = $this->scenario->find($id);

        return view('scenario.manage_detail', compact('detail'));*/
    }
}
