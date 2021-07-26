<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Requests\Character\ManageRequest;
use App\Http\Requests\Character\EditRequest;
use App\Http\Requests\Character\DeleteRequest;
use App\Http\Requests\Scenario\JoinRequest;
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


    public function insert(JoinRequest $request)
    {
        DB::transaction(function () use ($request) {
            $this->character->joinScenario($request->validated());
        });

        return redirect()->route('characters.manage')->with('msg_success', 'セッションに参加しました。');
    }


    public function manage(ManageRequest $request)
    {
        $input = $request->validated();
        $characters = $this->character->getManageList($input);

        return view('character.manage', compact(['characters', 'input']));
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
        $input = $request->validated();
        DB::transaction(function () use ($input) {
            $this->character->updateCharacter($input);
        });

        return redirect()->route('characters.manage_detail', ['id' => $input['id']])->with('msg_success', 'キャラクターを編集しました。');
    }


    public function delete(DeleteRequest $request)
    {
        $input = $request->validated();

        DB::transaction(function () use($input) {
            $this->character->deleteCharacter($input['id']);
        });

        return redirect()->route('characters.manage')->with('msg_success', 'キャラクターを削除しました。');
    }
}
