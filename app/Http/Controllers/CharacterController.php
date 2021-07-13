<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Requests\Character\ManageRequest;
use App\Http\Requests\Character\EditRequest;
use App\Http\Requests\Character\DeleteRequest;
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
        $validator = Validator::make(
            ['id' => $id],
            ['id' => [
                'bail',
                'required',
                'integer',
                Rule::exists('characters', 'id')->where('user_friend_code', Auth::user()->friend_code),
            ]]
        );

        if ($validator->fails()) {
            return redirect()->route('characters.manage')->with('msg_failure', '不正な値が入力されました。');
        }

        $detail = $this->character->find($id);

        return view('character.manage_detail', compact('detail'));
    }


    public function edit($id)
    {
        $validator = Validator::make(
            ['id' => $id],
            ['id' => [
                'bail',
                'required',
                'integer',
                Rule::exists('characters', 'id')->where('user_friend_code', Auth::user()->friend_code),
            ]]
        );

        if ($validator->fails()) {
            return redirect()->route('characters.manage')->with('msg_failure', '不正な値が入力されました。');
        }

        $detail = $this->character->find($id);

        return view('character.edit', compact('detail'));
    }


    public function update(EditRequest $request)
    {
        $inputs = $request->validated();
        DB::transaction(function () use ($inputs) {
            $this->character->updateCharacter($inputs);
        });

        return redirect()->route('characters.manage_detail', ['id' => $inputs['id']])->with('msg_success', 'キャラクターを編集しました。');
    }


    public function delete(DeleteRequest $request)
    {
        $inputs = $request->validated();

        DB::transaction(function () use($inputs) {
            $this->character->deleteCharacter($inputs['id']);
        });

        return redirect()->route('characters.manage')->with('msg_success', 'キャラクターを削除しました。');
    }
}
