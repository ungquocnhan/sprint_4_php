<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnteingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('anteing')->insert([
            ['quantity' => 1],
            ['quantity' => 2],
            ['quantity' => 3],
            ['quantity' => 4],
            ['quantity' => 6],
            ['quantity' => 7],
            ['quantity' => 8],
        ]);
    }
}
