<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Http\Requests\User\AddRequest;
use App\Http\Requests\User\EditRequest;
use App\Http\Requests\User\LoginRequest;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    //
    public function add()
    {
        return view('user.add');
    }

    public function insert(AddRequest $request)
    {
        DB::transaction(function () use($request) {
            $this->user->insertUser($request->all());
        });

        return redirect()->route('login')->with('msg_success', 'アカウントを作成しました');
    }

    public function edit()
    {
        return view('user.edit');
    }

    public function update(EditRequest $request)
    {
        DB::transaction(function () use($request) {
            $this->user->updateUser($request->all());
        });
        
        return redirect()->route('top')->with('msg_success', 'ユーザー名を変更しました');
    }

    public function login()
    {
        return view('user.login');
    }

    public function login_update(LoginRequest $request)
    {
        DB::transaction(function () use($request) {
            $this->user->updateLogin($request->all());
        });

        return redirect()->route('top')->with('msg_success', 'ログイン情報を変更しました');
    }
}
