<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(FriendSeeder::class);
        $this->call(ScenarioSeeder::class);
        $this->call(CharacterSeeder::class);
        $this->call(JoinHistorySeeder::class);
    }
}
