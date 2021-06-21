<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJoinHistorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('join_historys', function (Blueprint $table) {
            
            $table->foreignId('scenario_id')->constrained();        // シナリオID      
            $table->foreignId('character_id')->constrained();       // キャラクターID
            $table->tinyInteger('status')->default(1)->unsigned();  // ステータス
            $table->datetimeTz('joined_at');                          // 参加決定日

            $table->primary(['scenario_id', 'character_id']);		// 複合主キー
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('join_historys');
    }
}
