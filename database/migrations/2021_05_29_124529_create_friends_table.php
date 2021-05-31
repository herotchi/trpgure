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
            
            $table->foreignId('following_user_id')->constrained('users', 'id');     // シナリオID      
            $table->foreignId('followed_user_id')->constrained('users', 'id');      // キャラクターID
            $table->datetimeTz('follow_at');                                        // 参加決定日

            $table->primary(['following_user_id', 'followed_user_id']);		// 複合主キー

            
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
