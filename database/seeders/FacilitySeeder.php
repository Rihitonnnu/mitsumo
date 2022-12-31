<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Facility::factory(5)->create();
    }
}
