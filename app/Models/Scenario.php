<?php

namespace App\Models;

use App\Consts\TopConsts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function users()
    {
        return $this->belongsTo(User::class, 'user_friend_code', 'friend_code');
    }


    public function characters()
    {
        return $this->belongsToMany(Character::class, 'join_historys', 'scenario_id', 'character_id')->withPivot('status', 'join_datetime');
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
}
