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
        'character_sheet',
    ];


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
}
