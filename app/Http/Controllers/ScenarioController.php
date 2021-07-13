<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Consts\ScenarioConsts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Scenario;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Rules\Followed;
use App\Http\Requests\Scenario\AddRequest;
use App\Http\Requests\Scenario\EditRequest;
use App\Http\Requests\Scenario\ListRequest;
use App\Http\Requests\Scenario\JoinRequest;
use App\Http\Requests\Scenario\ManageRequest;
use App\Http\Requests\Scenario\DeleteRequest;


class ScenarioController extends Controller
{
    //
    protected $scenario;
    protected $user;
    protected $followed;


    public function __construct(Scenario $scenario, User $user, Followed $followed)
    {
        $this->scenario = $scenario;
        $this->user = $user;
        $this->followed = $followed;
    }


    public function list(ListRequest $request)
    {
        $friendLists = $this->user->getFriendList();
        $inputs = $request->validated();
        $lists = $this->scenario->getList($inputs);

        return view('scenario.list', compact(['friendLists', 'lists', 'inputs']));
    }


    public function detail($id)
    {
        $validator = Validator::make(
            ['id' => $id],
            ['id' => [
                'bail',
                'required',
                'integer',
                Rule::exists('scenarios', 'id')->where('public_flg', ScenarioConsts::PUBLIC_FLG_PUBLIC),
                Rule::unique('scenarios', 'id')->where('user_friend_code', Auth::user()->friend_code),
                $this->followed
            ]]
        );

        if ($validator->fails()) {
            return redirect()->route('scenarios.list')->with('msg_failure', '不正な値が入力されました。');
        }

        $detail = $this->scenario->find($id);

        // 閲覧者がシナリオ主催者をフォローしているか確認する
        $followingFlg = $this->checkFollowingHost($detail);
        if (!$followingFlg) {
            return redirect()->route('scenarios.list')->with('msg_failure', '不正な値が入力されました。');
        }

        // 閲覧者がシナリオ主催者にフォローされているか確認する
        $followedFlg = $this->checkFollowedHost($detail);

        return view('scenario.detail', compact(['detail', 'followingFlg', 'followedFlg']));
    }


    public function join(JoinRequest $request)
    {
        $inputs = $request->validated();

        /*
        $detail = $this->scenario->find($inputs['scenario_id']);
        // 閲覧者とシナリオ主催者が相互フォロー状態じゃないとシナリオに参加できない
        if (!$this->checkFollowingHost($detail) || !$this->checkFollowedHost($detail)) {
            return redirect()->route('scenarios.list')->with('msg_failure', '不正な値が入力されました。');
        }*/

        DB::transaction(function () use ($inputs) {
            $this->scenario->joinScenario($inputs);
        });

        return redirect()->route('scenarios.detail', ['id' => $inputs['scenario_id']])->with('msg_success', 'シナリオに参加しました。');
    }


    public function manage(ManageRequest $request)
    {
        $friendLists = $this->user->getFriendList();
        $inputs = $request->validated();
        $lists = $this->scenario->getManageList($inputs);

        return view('scenario.manage', compact(['friendLists', 'lists', 'inputs']));
    }


    public function manage_detail($id)
    {
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

        return view('scenario.manage_detail', compact('detail'));
    }


    public function add()
    {
        return view('scenario.add');
    }


    public function insert(AddRequest $request)
    {
        DB::transaction(function () use ($request) {
            $this->scenario->insertScenario($request->validated());
        });

        return redirect()->route('scenarios.manage')->with('msg_success', 'シナリオを登録しました。');
    }


    public function edit($id)
    {
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

        return view('scenario.edit', compact('detail'));
    }


    public function update(EditRequest $request)
    {
        $inputs = $request->validated();
        DB::transaction(function () use ($inputs) {
            $this->scenario->updateScenario($inputs);
        });

        return redirect()->route('scenarios.manage_detail', ['id' => $inputs['id']])->with('msg_success', 'シナリオを編集しました。');
    }


    public function delete(DeleteRequest $request)
    {
        $inputs = $request->validated();

        DB::transaction(function () use($inputs) {
            $this->scenario->deleteScenario($inputs['id']);
        });

        return redirect()->route('scenarios.manage')->with('msg_success', 'シナリオを削除しました。');
    }


    /**
     * 閲覧者がシナリオ主催者をフォローしているか確認する
     *
     * @param App\Models\Scenario $detail
     * @return boolean
     */
    private function checkFollowingHost(Scenario $detail)
    {
        $count = $detail->user->followeds->where('friend_code', Auth::user()->friend_code)->count();
        if ($count === 1) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * 閲覧者がシナリオ主催者にフォローされているか確認する
     *
     * @param App\Models\Scenario $detail
     * @return boolean
     */
    private function checkFollowedHost(Scenario $detail)
    {
        $count = $detail->user->followings->where('friend_code', Auth::user()->friend_code)->count();
        if ($count === 1) {
            return true;
        } else {
            return false;
        }
    }


}
