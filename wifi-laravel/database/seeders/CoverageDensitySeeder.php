<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoverageDensitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('coverage_density')->insert([
            ['name' => '10 m'],
            ['name' => '15 m'],
            ['name' => '20 m'],
            ['name' => '25 m'],
            ['name' => '15 - 20 m'],
            ['name' => '20 - 25 m'],
            ['name' => '20 - 30 m'],
            ['name' => '10 - 20 m'],
        ]);
    }
}
