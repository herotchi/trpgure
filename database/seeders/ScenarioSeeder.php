<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ScenarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('scenarios')->insert([
            'user_friend_code' => '12345678901a',
            'title' => 'タイトル１',
            'summary' => 'とっとこハム太郎１',
            'part_period_start' => '2021/05/20',
            'part_period_end' => '2021/07/30',
            'possible_date' => 'https://www.youtube.com',
            'genre' => 1,
            'platform' => 2,
            'rec_number_min' => 2,
            'rec_number_max' => 3,
            'rec_skill' => 'とっとこハム太郎２',
            'caution' => 'とっとこハム太郎３',
            'public_flg' => 1,
            'gm_memo' => 'とっとこハム太郎４',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('scenarios')->insert([
            'user_friend_code' => '12345678901c',
            'title' => 'タイトル２',
            'summary' => 'ボンバイエ１',
            'part_period_start' => '2021/06/05',
            'part_period_end' => '2021/07/21',
            'possible_date' => 'https://www.youtube.com',
            'genre' => 2,
            'platform' => 1,
            'rec_number_min' => 1,
            'rec_number_max' => 1,
            'rec_skill' => 'ボンバイエ２',
            'caution' => 'ボンバイエ３',
            'public_flg' => 1,
            'gm_memo' => 'ボンバイエ４',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
