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
        'user_friend_code',
        'name',
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

        // 自分が作成したシナリオのみを表示する
        $query->where('user_friend_code', Auth::user()->friend_code);

        $query->orderBy('updated_at', 'desc');

        $lists = $query->paginate(CharacterConsts::PAGENATE_MANAGE_LIMIT);

        return $lists;
    }


    public function updateCharacter(array $data)
    {
        $character = $this::find($data['id']);
        $character->fillable(['name', 'character_sheet']);
        $character->fill($data)->save();
    }


    public function deleteCharacter($id)
    {
        $this->where('id', $id)->delete();
    }
}
