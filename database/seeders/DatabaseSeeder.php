<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call(PositionTableSeeder::class);
        $this->call(LeaveTableSeeder::class);

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => '$2y$10$2Vq4dDTJMBGr1NHTye8PEeEIhEEwSCrgNMQA2S/zX3Glvyp/JqSja',
            'firstname' => 'admin',
            'lastname' => 'admin',
            'position_id' => '1',
            'start_job' =>  '2022-02-01',
        ]);
    }
}
