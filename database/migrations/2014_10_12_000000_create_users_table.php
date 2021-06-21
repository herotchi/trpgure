<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->id();			            // シーケンスID
            $table->char('friend_code', 12);	// フレンドコード
            $table->string('login_id', 100);	// ログインID
            $table->string('password');	        // パスワード
            $table->rememberToken();			// 持続ログイン用カラム
            $table->string('user_name', 12);	// ユーザー名
            $table->datetimeTz('created_at');
            $table->datetimeTz('updated_at');

            $table->index('friend_code');
            $table->unique('login_id');
            $table->unique('friend_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
