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
use App\Rules\FollowExchange;
use App\Http\Requests\Scenario\AddRequest;
use App\Http\Requests\Scenario\EditRequest;
use App\Http\Requests\Scenario\ListRequest;
use App\Http\Requests\Scenario\ManageRequest;
use App\Http\Requests\Scenario\DeleteRequest;
use App\Http\Requests\Scenario\CancelRequest;
use DateTime;


class ScenarioController extends Controller
{
    //
    protected $scenario;
    protected $user;
    protected $followed;
    protected $followExchange;


    public function __construct(Scenario $scenario, User $user, Followed $followed, FollowExchange $followExchange)
    {
        $this->scenario = $scenario;
        $this->user = $user;
        $this->followed = $followed;
        $this->followExchange = $followExchange;
    }


    public function list(ListRequest $request)
    {
        $followingList = $this->user->getFollowingList();
        $input = $request->validated();
        $scenarios = $this->scenario->getList(data_get($followingList->toArray(), '*.friend_code'), $input);

        return view('scenario.list', compact(['followingList', 'scenarios', 'input']));
    }


    public function detail($id)
    {

        $validator = Validator::make(
            ['id' => $id],
            ['id' => [
                'bail',
                'required',
                'integer',
                // 公開中で募集開始日が現在と同じか過去かつ募集終了日が現在と同じか未来のセッションのみ
                Rule::exists('scenarios', 'id')->where('public_flg', ScenarioConsts::PUBLIC_FLG_PUBLIC)->where(function ($query) {
                    $today = new Datetime();
                    return $query->where('part_period_start', '<=', $today->format('Y-m-d'))->where('part_period_end', '>=', $today->format('Y-m-d'));
                }),
                // 自分が募集したセッションではない
                Rule::unique('scenarios', 'id')->where('user_friend_code', Auth::user()->friend_code),
                // 閲覧者がセッション募集者をフォローしているか確認
                $this->followed
            ]]
        );

        if ($validator->fails()) {
            return redirect()->route('scenarios.list')->with('msg_failure', '不正な値が入力されました。');
        }

        $detail = $this->scenario->with('characters.user')->find($id);

        // 閲覧者がセッション募集者をフォローしているか確認する
        $followingFlg = $this->checkFollowingHost($detail);
        // 閲覧者がセッション募集者にフォローされているか確認する
        $followedFlg = $this->checkFollowedHost($detail);
        // 閲覧者がすでにセッションに参加しているか確認する
        $joiningFlg = $this->checkJoining($detail);

        return view('scenario.detail', compact(['detail', 'followingFlg', 'followedFlg', 'joiningFlg']));
    }


    public function join($id)
    {
        $validator = Validator::make(
            ['id' => $id],
            ['id' => [
                'bail',
                'required',
                'integer',
                // 公開中で募集開始日が現在と同じか過去かつ募集終了日が現在と同じか未来のセッションのみ
                Rule::exists('scenarios', 'id')->where('public_flg', ScenarioConsts::PUBLIC_FLG_PUBLIC)->where(function ($query) {
                    $today = new Datetime();
                    return $query->where('part_period_start', '<=', $today->format('Y-m-d'))->where('part_period_end', '>=', $today->format('Y-m-d'));
                }),
                // ユーザーとセッション募集者が相互フォロー状態
                $this->followExchange,
                // まだ参加していない
                Rule::unique('characters', 'scenario_id')->where('user_friend_code', Auth::user()->friend_code),
            ]]
        );

        if ($validator->fails()) {
            return redirect()->route('scenarios.list')->with('msg_failure', '不正な値が入力されました。');
        }

        $detail = $this->scenario->find($id);

        return view('scenario.join', compact('detail'));
    }


    public function manage(ManageRequest $request)
    {
        $input = $request->validated();
        $scenarios = $this->scenario->getManageList($input);

        return view('scenario.manage', compact(['scenarios', 'input']));
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

        $detail = $this->scenario->with('characters.user')->find($id);
        $joinedFlg = $this->checkJoined($detail);

        return view('scenario.manage_detail', compact(['detail', 'joinedFlg']));
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

        return redirect()->route('scenarios.manage')->with('msg_success', 'セッションを募集しました。');
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
        $input = $request->validated();
        DB::transaction(function () use ($input) {
            $this->scenario->updateScenario($input);
        });

        return redirect()->route('scenarios.manage_detail', ['id' => $input['id']])->with('msg_success', 'セッションを編集しました。');
    }


    public function delete(DeleteRequest $request)
    {
        $input = $request->validated();

        DB::transaction(function () use($input) {
            $this->scenario->deleteScenario($input['id']);
        });

        return redirect()->route('scenarios.manage')->with('msg_success', 'セッションを削除しました。');
    }


    public function cancel(CancelRequest $request)
    {
        $input = $request->validated();
        DB::transaction(function () use($input) {
            $this->scenario->cancelScenario($input['id']);
        });

        return redirect()->route('scenarios.list')->with('msg_success', 'セッションの参加を取り消しました。');
    }


    /**
     * 閲覧者がセッション募集者をフォローしているか確認する
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
     * 閲覧者がセッション募集者にフォローされているか確認する
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


    /**
     * 閲覧者がセッションに参加しているか確認する
     *
     * @param Scenario $detail
     * @return boolean
     */
    private function checkJoining(Scenario $detail)
    {
        $count = $detail->characters->where('user_friend_code', Auth::user()->friend_code)->count();
        if ($count === 1) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * 募集したセッションに参加者がいるか確認
     *
     * @param Scenario $detail
     * @return boolean
     */
    private function checkJoined(Scenario $detail)
    {
        $count = $detail->characters->count();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }
}
