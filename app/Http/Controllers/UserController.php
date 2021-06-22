<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Http\Requests\User\AddRequest;
use App\Http\Requests\User\EditRequest;
use Illuminate\Support\Facades\Auth;

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
        //return view('user.login');
    }
}
