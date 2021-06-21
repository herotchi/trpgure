<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            
            $table->char('following_friend_code', 12);     // フォローした人
            $table->char('followed_friend_code', 12);      // フォローされた人
            $table->datetimeTz('followed_at');               // 申請日

            $table->primary(['following_friend_code', 'followed_friend_code']);		    // 複合主キー
            $table->foreign('following_friend_code')->references('friend_code')->on('users');
            $table->foreign('followed_friend_code')->references('friend_code')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friends');
    }
}
