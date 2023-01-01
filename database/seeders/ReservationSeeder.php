<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservations')->insert([
            [
                'user_id' => 1,
                'facility_id' => 1,
                'starttime' => '2023-01-01 13:00:00',
                'endtime' => '2022-01-01 14:00:00',
                'perpose' => '実験のため',
            ],
        ]);
    }
}
