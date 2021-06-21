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
            'name' => 'キャラクター１',
            'character_sheet' => 'https://www.youtube.com',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('characters')->insert([
            'user_friend_code' => '12345678901c',
            'name' => 'キャラクター２',
            'character_sheet' => 'https://www.youtube.com',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('characters')->insert([
            'user_friend_code' => '12345678901b',
            'name' => 'キャラクター３',
            'character_sheet' => 'https://www.youtube.com',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
