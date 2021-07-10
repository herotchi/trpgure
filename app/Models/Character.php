<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

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
}
