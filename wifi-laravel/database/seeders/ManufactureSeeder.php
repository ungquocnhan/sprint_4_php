<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManufactureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('manufacture')->insert([
            ['name' => 'Totolink'],
            ['name' => 'Mercusys'],
            ['name' => 'Tp-Link'],
            ['name' => 'Tenda'],
            ['name' => 'Asus'],
            ['name' => 'Dlink'],
            ['name' => 'Linksys'],
            ['name' => 'Xiaomi'],
            ['name' => 'Aruba'],
        ]);
    }
}
