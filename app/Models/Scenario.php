<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Consts\TopConsts;
use App\Consts\ScenarioConsts;
use App\Consts\JoinHistoryConsts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

use DateTime;

class Scenario extends Model
{
    use HasFactory;

    protected $table = 'scenarios';
    protected $primaryKey = 'id';
    protected $dates = [
        'part_period_start',
        'part_period_end',
    ];

    protected $fillable = [
        'title',
        'summary',
        'part_period_start',
        'part_period_end',
        'possible_date',
        'genre',
        'platform',
        'rec_number_min',
        'rec_number_max',
        'rec_skill',
        'caution',
        'public_flg',
        'gm_memo',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_friend_code', 'friend_code');
    }

    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    public function getTopList($friendCodes)
    {
        $today = new Datetime();
        $query = $this::query();
        $query->whereIn('user_friend_code', $friendCodes);
        $query->where('scenarios.public_flg', TopConsts::PUBLIC_FLG_PUBLIC);
        $query->where('scenarios.part_period_end', '>=', $today);
        $query->orderBy('scenarios.part_period_end', 'asc');
        $lists = $query->with('users')->get();

        return $lists;
    }


    public function getList(array $data)
    {
        $query = $this::query();

        $query->when(Arr::exists($data, 'title') && $data['title'], function ($query) use ($data) {
            return $query->where('scenarios.title', 'like', "%{$data['title']}%");
        });

        $query->when(Arr::exists($data, 'friend_code') && $data['friend_code'], function ($query) use ($data) {
            return $query->where('scenarios.user_friend_code', $data['friend_code']);
        });

        $query->when(Arr::exists($data, 'genre') && $data['genre'], function ($query) use ($data) {
            return $query->where('scenarios.genre', $data['genre']);
        });

        // 他人が作成したシナリオのみを表示する
        $query->where('scenarios.user_friend_code', '<>', Auth::user()->friend_code);

        // シナリオ一覧では公開中のシナリオのみ表示する
        $query->where('scenarios.public_flg', ScenarioConsts::PUBLIC_FLG_PUBLIC);

        $query->orderBy('scenarios.updated_at', 'desc');

        $lists = $query->with('users')->paginate(ScenarioConsts::PAGENATE_LIST_LIMIT);

        return $lists;
    }


/*
    public function getList(array $data)
    {
        $query = $this::query();
        $query->join('users','scenarios.user_friend_code','=','users.friend_code');

        $query->when(Arr::exists($data, 'title') && $data['title'], function ($query) use ($data) {
            return $query->where('scenarios.title', 'like', "%{$data['title']}%");
        });

        $query->when(Arr::exists($data, 'friend_code') && $data['friend_code'], function ($query) use ($data) {
            return $query->where('scenarios.user_friend_code', $data['friend_code']);
        });

        $query->when(Arr::exists($data, 'genre') && $data['genre'], function ($query) use ($data) {
            return $query->where('scenarios.genre', $data['genre']);
        });

        // 他人が作成したシナリオのみを表示する
        $query->where('scenarios.user_friend_code', '<>', Auth::user()->friend_code);

        // シナリオ一覧では公開中のシナリオのみ表示する
        $query->where('scenarios.public_flg', ScenarioConsts::PUBLIC_FLG_PUBLIC);

        $query->orderBy('scenarios.updated_at', 'desc');
        
        $lists = $query->paginate(ScenarioConsts::PAGENATE_LIST_LIMIT, [
            'scenarios.id as id', 
            'scenarios.title as title', 
        ]);

        return $lists;
    }*/


    public function insertScenario(array $data)
    {
        $this->user_friend_code = Auth::user()->friend_code;
        $this->fill($data);

        $this->save();
    }


    public function joinScenario(array $data)
    {
        $scenario = $this::find($data['scenario_id']);
        $scenario->characters()->create([
            'user_friend_code' => Auth::user()->friend_code,
            'name' => $data['name'], 
            'character_sheet' => $data['character_sheet'], 
        ]);
    }
}
