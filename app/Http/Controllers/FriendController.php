<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Friend;
use App\Http\Requests\Friend\AddRequest;
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

        return view('friend.manage', compact('user'));
    }


    public function follow()
    {

    }


    public function remove()
    {

    }


    public function add()
    {
        return view('friend.add');
    }

    public function insert(AddRequest $request)
    {
        DB::transaction(function () use($request) {
            $this->friend->follow(Auth::user()->friend_code, $request->friend_code);
        });

        return redirect()->route('top')->with('msg_success', 'フレンドを登録しました。');
    }
}
