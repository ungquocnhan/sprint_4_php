<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('promotion')->insert([
            ['percent_promotion' => 0.05],
            ['percent_promotion' => 0.1],
            ['percent_promotion' => 0.15],
            ['percent_promotion' => 0.2],
            ['percent_promotion' => 0.25],
            ['percent_promotion' => 0.3],
            ['percent_promotion' => 0.4],
            ['percent_promotion' => 0.5],
            ['percent_promotion' => 0],

        ]);
    }
}
