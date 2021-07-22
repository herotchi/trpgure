<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use App\Models\Scenario;
use App\Models\User;

class TopController extends Controller
{
    /**
     * @var Scenario
     */
    protected $scenario;
    protected $user;

    public function __construct(Scenario $scenario, User $user)
    {
        $this->scenario = $scenario;
        $this->user = $user;
    }

    public function top() 
    {
        // フォローしているフレンドが募集するセッションのみ取得する
        $followingList = $this->user->getFollowingList();
        $scenarios = $this->scenario->getTopList(data_get($followingList->toArray(), '*.friend_code'));

        return view('top', compact('scenarios'));
    }


    public function terms_of_use()
    {
        return view('terms_of_use');
    }


    public function privacy_policy()
    {
        return view('privacy_policy');
    }
}
