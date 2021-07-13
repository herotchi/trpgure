<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Friend;
use App\Http\Requests\Friend\AddRequest;
use App\Http\Requests\Friend\FollowRequest;
use App\Http\Requests\Friend\RemoveRequest;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    //
    protected $friend;
    protected $user;

    public function __construct(Friend $friend, User $user)
    {
        $this->friend = $friend;
        $this->user = $user;
    }


    public function manage()
    {
        $user = $this->user->find(Auth::user()->id);
        $friendCodes = data_get($user->followings->toArray(), '*.friend_code');

        return view('friend.manage', compact(['user', 'friendCodes']));
    }


    public function follow(FollowRequest $request)
    {
        $input = $request->validated();

        DB::transaction(function () use($input) {
            $this->friend->followUser(Auth::user()->friend_code, $input['friend_code']);
        });

        return redirect()->route('friends.manage')->with('msg_success', 'フレンドを登録しました。');
    }


    public function remove(RemoveRequest $request)
    {
        $inputs = $request->validated();

        DB::transaction(function () use($inputs) {
            $this->friend->removeFollow(Auth::user()->friend_code, $inputs['friend_code']);
        });

        return redirect()->route('friends.manage')->with('msg_success', 'フォローを解除しました。');
    }


    public function add()
    {
        return view('friend.add');
    }


    public function insert(AddRequest $request)
    {
        $data = $request->validated();
        DB::transaction(function () use($data) {
            $this->friend->followUser(Auth::user()->friend_code, $data['friend_code']);
        });

        return redirect()->route('friends.manage')->with('msg_success', 'フレンドを登録しました。');
    }
}
