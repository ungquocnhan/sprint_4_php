<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('port')->insert([
                ['name' => '3 x LAN 1 x WAN 1 x USB 2.0'],
                ['name' => '4 x LAN 1 x WAN 2 x USB 3.1'],
                ['name' => '4 x LAN 1 x WAN'],
                ['name' => '2 x LAN 1 x WAN'],
                ['name' => '1 X LAN 1 x WAN'],
                ['name' => '3 x LAN 1 x WAN'],
                ['name' => '4 x LAN 1 x WAN 1 x USB 3.0'],
                ['name' => '4 x LAN 1 x WAN 1 x USB 2.0'],

            ]
        );
    }
}
