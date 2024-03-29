<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    // 作成日のみ有効
    const CREATED_AT = 'followed_at';
    const UPDATED_AT = null;

    protected $table = 'friends';

    // プライマリキー設定
    protected $primaryKey = ['following_friend_code', 'followed_friend_code'];
    // increment無効化
    public $incrementing = false;


    /**
     * フォロー処理を行う
     *
     * @param string $followingFriendCode 自分のフレンドコード
     * @param string $followedFriendCode フォロー対象のフレンドコード
     * @return void
     */
    public function followUser(string $followingFriendCode, string $followedFriendCode)
    {
        $this->following_friend_code = $followingFriendCode;
        $this->followed_friend_code = $followedFriendCode;
        $this->save();
    }

    /**
     * フォロー解除処理を行う
     *
     * @param string $followingFriendCode 自分のフレンドコード
     * @param string $followedFriendCode フォロー解除対象のフレンドコード
     * @return void
     */
    public function removeFollow(string $followingFriendCode, string $followedFriendCode)
    {
        $this->where('following_friend_code', $followingFriendCode)->where('followed_friend_code', $followedFriendCode)->delete();
    }
}
