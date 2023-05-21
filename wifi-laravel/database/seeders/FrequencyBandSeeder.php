<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FrequencyBandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('frequency_band')->insert([
            ['name' => '2.4 GHZ'],
            ['name' => '5 GHZ'],
            ['name' => '2.4 GHz & 5 GHz'],

        ]);
    }
}
