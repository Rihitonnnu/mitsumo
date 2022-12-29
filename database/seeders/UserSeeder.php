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
        DB::table('users')->insert([
            [
                'name' => 'normal',
                'email' => 'normal@test.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
            ],
            [
                'name' => 'admin',
                'email' => 'admin@test.com',
                'password' => Hash::make('password123'),
                'is_admin' => true,
            ],
        ]);
    }
}
