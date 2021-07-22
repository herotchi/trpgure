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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_friend_code', 'friend_code');
    }

    public function characters()
    {
        return $this->hasMany(Character::class);
    }


    /**
     * トップ画面に表示する最近の自分主催以外のフレンドが主催したセッション一覧を取得する
     *
     * @param array $friendCodes フォローしているフレンドのコード一覧
     * @return object $list
     */
    public function getTopList(array $friendCodes)
    {
        $today = new Datetime();
        $query = $this::query();
        $query->whereIn('user_friend_code', $friendCodes);
        $query->where('user_friend_code', '<>', Auth::user()->friend_code);
        $query->where('public_flg', TopConsts::PUBLIC_FLG_PUBLIC);
        // 募集開始日が現在と同じか過去のセッションのみ
        $query->where('part_period_start', '<=', $today->format('Y-m-d'));
        // 募集終了日が現在と同じか未来のセッションのみ
        $query->where('part_period_end', '>=', $today->format('Y-m-d'));
        $query->orderBy('part_period_end', 'asc');
        $list = $query->with('user')->get();

        return $list;
    }


    /**
     * フォローしているフレンドが募集しているセッションのみ取得する
     *
     * @param array $friendCodes フォローしているフレンドのコード一覧
     * @param array $data
     * @return object $list
     */
    public function getList(array $friendCodes ,array $data)
    {
        $today = new Datetime();
        $query = $this::query();
        $query->whereIn('user_friend_code', $friendCodes);
        $query->when(Arr::exists($data, 'title') && $data['title'], function ($query) use ($data) {
            return $query->where('scenarios.title', 'like', "%{$data['title']}%");
        });
        $query->when(Arr::exists($data, 'friend_code') && $data['friend_code'], function ($query) use ($data) {
            return $query->where('scenarios.user_friend_code', $data['friend_code']);
        });
        $query->when(Arr::exists($data, 'genre') && $data['genre'], function ($query) use ($data) {
            return $query->where('scenarios.genre', $data['genre']);
        });
        // 他人が募集したセッションのみを表示する
        $query->where('scenarios.user_friend_code', '<>', Auth::user()->friend_code);
        // セッション一覧では公開中のセッションのみ表示する
        $query->where('scenarios.public_flg', ScenarioConsts::PUBLIC_FLG_PUBLIC);
        // 募集開始日が現在と同じか過去のセッションのみ
        $query->where('part_period_start', '<=', $today->format('Y-m-d'));
        // 募集終了日が現在と同じか未来のセッションのみ
        $query->where('part_period_end', '>=', $today->format('Y-m-d'));
        $query->orderBy('scenarios.updated_at', 'desc');
        $list = $query->with('user')->paginate(ScenarioConsts::PAGENATE_LIST_LIMIT);

        return $list;
    }


    public function getManageList(array $data)
    {
        $query = $this::query();

        $query->when(Arr::exists($data, 'title') && $data['title'], function ($query) use ($data) {
            return $query->where('title', 'like', "%{$data['title']}%");
        });

        $query->when(Arr::exists($data, 'genre') && $data['genre'], function ($query) use ($data) {
            return $query->where('genre', $data['genre']);
        });

        $query->when(Arr::exists($data, 'platform') && $data['platform'], function ($query) use ($data) {
            return $query->where('platform', $data['platform']);
        });

        $query->when(Arr::exists($data, 'public_flg') && $data['public_flg'], function ($query) use ($data) {
            return $query->where('public_flg', $data['public_flg']);
        });

        // 自分が募集したセッションのみを表示する
        $query->where('user_friend_code', Auth::user()->friend_code);

        $query->orderBy('updated_at', 'desc');

        $lists = $query->paginate(ScenarioConsts::PAGENATE_MANAGE_LIMIT);

        return $lists;
    }


    public function insertScenario(array $data)
    {
        $this->user_friend_code = Auth::user()->friend_code;
        $this->fill($data);

        $this->save();
    }


    /**
     * セッション参加処理
     *
     * @param array $data
     * @return void
     */
    public function joinScenario(array $data)
    {
        $scenario = $this::find($data['id']);
        $scenario->characters()->create([
            'user_friend_code' => Auth::user()->friend_code,
            'name' => $data['name'], 
            'character_sheet' => $data['character_sheet'], 
        ]);
    }



    public function cancelScenario($id)
    {
        $scenario = $this::find($id);
        $scenario->characters()->where('scenario_id', $id)->where('user_friend_code', Auth::user()->friend_code)->delete();
    }


    public function updateScenario(array $data)
    {
        $scenario = $this::find($data['id']);
        $scenario->fill($data)->save();
    }


    public function deleteScenario($id)
    {
        $this->where('id', $id)->delete();
    }
}
