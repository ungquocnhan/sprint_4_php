<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MadeInSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('made_in')->insert([
            ['name' => 'Trung Quốc'],
            ['name' => 'Việt Nam'],
            ['name' => 'Mỹ'],
        ]);
    }
}
