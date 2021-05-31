<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class FriendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('friends')->insert([
            'following_friend_code' => '12345678901a',
            'followed_friend_code' => '12345678901b',
            'follow_at' => now()
        ]);

        DB::table('friends')->insert([
            'following_friend_code' => '12345678901b',
            'followed_friend_code' => '12345678901a',
            'follow_at' => now()
        ]);

        DB::table('friends')->insert([
            'following_friend_code' => '12345678901a',
            'followed_friend_code' => '12345678901c',
            'follow_at' => now()
        ]);

        DB::table('friends')->insert([
            'following_friend_code' => '12345678901c',
            'followed_friend_code' => '12345678901a',
            'follow_at' => now()
        ]);

        DB::table('friends')->insert([
            'following_friend_code' => '12345678901c',
            'followed_friend_code' => '12345678901b',
            'follow_at' => now()
        ]);
    }
}
