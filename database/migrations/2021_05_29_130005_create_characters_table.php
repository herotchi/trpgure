<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();                                       // シーケンスID
            $table->char('user_friend_code', 12);               // フレンドコード
            $table->foreignId('scenario_id')->constrained();    // シナリオID
            $table->string('name', 100);                        // キャラクター名
            $table->text('character_sheet')->nullable();        // キャラクターシートURL
            $table->datetimeTz('created_at');
            $table->datetimeTz('updated_at');

            $table->foreign('user_friend_code')->references('friend_code')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
    }
}
