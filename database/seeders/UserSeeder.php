<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'friend_code' => '12345678901a',
            'login_id' => 'test1test1',
            'password' => Hash::make('test1test1'),
            'remember_token' => '',
            'user_name' => 'test1',
            'create_at' => now(),
            'update_at' => now()
        ]);

        DB::table('users')->insert([
            'friend_code' => '12345678901b',
            'login_id' => 'test2test2',
            'password' => Hash::make('test2test2'),
            'remember_token' => '',
            'user_name' => 'test2',
            'create_at' => now(),
            'update_at' => now()
        ]);

        DB::table('users')->insert([
            'friend_code' => '12345678901c',
            'login_id' => 'test3test3',
            'password' => Hash::make('test3test3'),
            'remember_token' => '',
            'user_name' => 'test3',
            'create_at' => now(),
            'update_at' => now()
        ]);
    }
}
