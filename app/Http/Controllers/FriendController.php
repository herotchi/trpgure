<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Consts\UserConsts;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Friend;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Rules\AlphaNumJp;
use App\Rules\NotEqualFriendCode;
use App\Http\Requests\Friend\AddRequest;
use App\Http\Requests\Friend\RemoveRequest;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    //
    protected $friend;
    protected $user;
    protected $alphaNumJp;
    protected $notEqualFriendCode;

    public function __construct(Friend $friend, User $user, AlphaNumJp $alphaNumJp, NotEqualFriendCode $notEqualFriendCode)
    {
        $this->friend = $friend;
        $this->user = $user;
        $this->alphaNumJp = $alphaNumJp;
        $this->notEqualFriendCode = $notEqualFriendCode;
    }


    public function manage()
    {
        $user = $this->user->find(Auth::user()->id);
        $friendCodes = data_get($user->followings->toArray(), '*.friend_code');

        return view('friend.manage', compact(['user', 'friendCodes']));
    }


    public function follow($friendCode)
    {
        $validator = Validator::make(
            ['friend_code' => $friendCode],
            ['friend_code' => [
                'bail', 
                'required', 
                'string', 
                'size:' . UserConsts::FRIEND_CODE_LENGTH, 
                $this->alphaNumJp,
                'exists:users,friend_code',
                $this->notEqualFriendCode,
                // フォロー対象にフォローされているか確認
                Rule::exists('friends', 'following_friend_code')->where('followed_friend_code', Auth::user()->friend_code),
                Rule::unique('friends', 'followed_friend_code')->where('following_friend_code', Auth::user()->friend_code)
            ]]
        );

        if ($validator->fails()) {
            return redirect()->route('friends.manage')->with('msg_failure', '不正な値が入力されました。');
        }

        DB::transaction(function () use($friendCode) {
            $this->friend->followUser(Auth::user()->friend_code, $friendCode);
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
