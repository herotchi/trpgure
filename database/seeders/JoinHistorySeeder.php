<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class JoinHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('join_historys')->insert([
            'scenario_id' => 1,
            'character_id' => 1,
            'status' => 1,
            'joined_at' => now(),
        ]);

        DB::table('join_historys')->insert([
            'scenario_id' => 1,
            'character_id' => 2,
            'status' => 1,
            'joined_at' => now(),
        ]);

        DB::table('join_historys')->insert([
            'scenario_id' => 2,
            'character_id' => 3,
            'status' => 2,
            'joined_at' => now(),
        ]);
    }
}
