<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Consts\CharacterConsts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class Character extends Model
{
    use HasFactory;

    protected $table = 'characters';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'service',
        'character_sheet',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_friend_code', 'friend_code');
    }

    public function scenario()
    {
        return $this->belongsTo(Scenario::class);
    }

    public function getManageList(array $data)
    {
        $query = $this::query();

        $query->when(Arr::exists($data, 'name') && $data['name'], function ($query) use ($data) {
            return $query->where('name', 'like', "%{$data['name']}%");
        });

        // 自分が作成したキャラクターのみを表示する
        $query->where('user_friend_code', Auth::user()->friend_code);

        $query->orderBy('updated_at', 'desc');

        $lists = $query->with('scenario.user')->paginate(CharacterConsts::PAGENATE_MANAGE_LIMIT);

        return $lists;
    }


    /**
     * セッション参加処理
     *
     * @param array $data
     * @return void
     */
    public function joinScenario(array $data)
    {
        $this->user_friend_code = Auth::user()->friend_code;
        $this->scenario_id = $data['id'];
        $this->fill($data);

        $this->save();
    }


    public function updateCharacter(array $data)
    {
        $character = $this::find($data['id']);
        $character->fill($data)->save();
    }


    public function deleteCharacter($id)
    {
        $this->where('id', $id)->delete();
    }
}
