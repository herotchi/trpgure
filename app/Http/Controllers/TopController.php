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

    public function __invoke() {
        $user = $this->user->find(Auth::user()->id);
        $friendCodes = Arr::prepend(data_get($user->followeds->toArray(), '*.friend_code'), Auth::user()->friend_code);
        $lists = $this->scenario->getTopList($friendCodes);

        return view('top', compact('lists'));
    }
}
