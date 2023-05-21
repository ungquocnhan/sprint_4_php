<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ButtonSupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('button_support')->insert([
            ['name' => '1 nút WPS/RST'],
            ['name' => '1 nút Reset 1 nút WPS Nút Mở/Tắt nguồn'],
            ['name' => '1 nút Reset'],
            ['name' => '1 nút Reset1 nút 2.4GHz WPS1 nút 5GHz WPS'],
            ['name' => '1 nút WPS'],

        ]);
    }
}
