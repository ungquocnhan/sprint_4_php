<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpeedWifiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('speed_wifi')->insert([
            ['name' => '300 Mbps (băng tần 2.4GHz)'],
            ['name' => '574 Mbps (băng tần 2.4GHz), 1201 Mbps (băng tần 5GHz)'],
            ['name' => '300 Mbps (băng tần 2.4GHz), 867 Mbps (băng tần 5GHz)'],
            ['name' => '1148 Mbps (băng tần 2.4GHz), 4804 Mbps (băng tần 5GHz) x 2'],
            ['name' => '600 Mbps (băng tần 2.4GHz), 1200 Mbps (băng tần 5 GHz)'],
            ['name' => '300 Mbps (băng tần 2.4GHz), 433 Mbps (băng tần 5GHz)'],
            ['name' => '450 Mbps (băng tần: 2.4Hz), 1733 Mbps (băng tần 5GHz)'],
            ['name' => '433 Mbps (băng tần 5GHz), 200 Mbps (băng tần 2.4GHz)'],
            ['name' => '600 Mbps (băng tần 2.4GHz), 867 Mbps (băng tần 5GHz)'],
            ['name' => '574 Mbps (băng tần 2.4GHz), 2402 Mbps (băng tần 5GHz)'],
            ['name' => '400 Mbps (băng tần 2.4GHz), 867 Mbps (băng tần 5GHz)'],
        ]);
    }
}
