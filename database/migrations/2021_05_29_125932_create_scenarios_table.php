<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScenariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scenarios', function (Blueprint $table) {
            
            $table->id();                                               // シーケンスID
            $table->char('user_friend_code', 12);                       // フレンドコード
            $table->string('title', 100);								// タイトル
            $table->text('summary')->nullable();						// 概要
            $table->date('part_period_start');				            // 参加募集開始日時
            $table->date('part_period_end');				            // 参加募集終了日時
            $table->text('possible_date')->nullable();				    // 実施候補日
            $table->tinyInteger('genre')->unsigned();					// ジャンル
            $table->tinyInteger('platform')->unsigned();				// プラットフォーム
            $table->integer('rec_number_min')->unsigned()->nullable();	// 最小推奨人数
            $table->integer('rec_number_max')->unsigned()->nullable();	// 最大推奨人数
            $table->text('rec_skill')->nullable();						// 推奨取得技能
            $table->text('caution')->nullable();						// 注意事項
            $table->tinyInteger('public_flg')->default(2)->unsigned();	// 公開フラグ
            $table->text('gm_memo')->nullable();						// GM用メモ
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
        Schema::dropIfExists('scenarios');
    }
}
