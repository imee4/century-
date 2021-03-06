<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            [
                'user_type_id' => 1,
                'profile_id' => 1,
                'email' => 'super@demo.com',
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10)
                ],
                [
                    'user_type_id' => 2,
                    'profile_id' => 1,
                    'email' => 'admin@demo.com',
                    'password' => bcrypt('password'),
                    'remember_token' => Str::random(10)
                ]
        ]);
    }
}
