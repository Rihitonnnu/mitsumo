<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('facilities')->insert([
            [
                'name' => 'ドライブシミュレータ',
            ],
            [
                'name' => 'PC(GTX-3080)',
            ],
        ]);
    }
}
