<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('characters')->insert([
            'user_friend_code' => '12345678901b',
            'scenario_id' => 1,
            'name' => 'キャラクター１',
            'service' => 1,
            'character_sheet' => '/char/1765178/view',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('characters')->insert([
            'user_friend_code' => '12345678901c',
            'scenario_id' => 1,
            'name' => 'キャラクター２',
            'service' => 2,
            'character_sheet' => '/3765301',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('characters')->insert([
            'user_friend_code' => '12345678901b',
            'scenario_id' => 2,
            'name' => 'キャラクター３',
            'service' => 3,
            'character_sheet' => '/view/21664',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
