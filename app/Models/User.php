<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Support\Facades\Hash;

use App\Consts\UserConsts;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name',
        'login_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // フォローしているユーザー
    public function followings()
    {
        return $this->belongsToMany(self::class, 'friends', 'following_friend_code', 'followed_friend_code', 'friend_code', 'friend_code')->withPivot(['followed_at', 'users.id'])->orderBy('pivot_followed_at', 'desc')->orderBy('users.id', 'desc');
    }

    // フォローされているユーザー
    public function followeds()
    {
        return $this->belongsToMany(self::class, 'friends', 'followed_friend_code', 'following_friend_code', 'friend_code', 'friend_code')->withPivot(['followed_at', 'users.id'])->orderBy('pivot_followed_at', 'desc')->orderBy('users.id', 'desc');
    }

    public function insertUser(array $data)
    {
        $this->login_id = $data['login_id'];
        $this->password = Hash::make($data['password']);
        $this->user_name = $data['user_name'];
        $this->friend_code = $this->generateFriendCode();
        $this->save();
    }


    public function updateUser(array $data)
    {
        $user = $this->find(Auth::user()->id);
        $user->user_name = $data['user_name'];
        $user->save();
    }


    public function updateLogin(array $data)
    {
        $user = $this->find(Auth::user()->id);
        $user->login_id = $data['login_id'];
        if (strlen($data['password']) > 0) {
            $user->password = Hash::make($data['password']);
        }
        $user->save();
    }

    /**
     * フレンドコードを生成する
     *
     * @return string $friendCode
     */
    public function generateFriendCode()
    {
        $count = 0;

        // 10回フレンドコードを生成してもユニークでなかった場合、ループを強制終了して例外を投げる
        do {
            $friendCode = substr(str_shuffle(UserConsts::FRIEND_CODE_STRING), 0, UserConsts::FRIEND_CODE_LENGTH);
            $count++;
            if ($count > UserConsts::FRIEND_CODE_GENERATE_LIMIT) {
                break;
            }
        } while ($this->where('friend_code', $friendCode)->count() !== 0);

        if ($count > UserConsts::FRIEND_CODE_GENERATE_LIMIT) {
            throw new \Exception("アカウント作成に失敗しました。");
        } else {
            return $friendCode;
        }
    }
}
