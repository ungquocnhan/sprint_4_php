<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuaranteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('guarantee')->insert([
            ['name' => '12 thang'],
            ['name' => '18 thang'],
            ['name' => '24 thang'],
            ['name' => '36 thang'],

        ]);
    }
}
