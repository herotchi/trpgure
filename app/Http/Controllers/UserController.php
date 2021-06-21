<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Http\Requests\User\AddRequest;

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
}
