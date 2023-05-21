<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserConnect extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_connect')->insert([
            ['name' => '20 - 25 user'],
            ['name' => '25 - 30 user'],
            ['name' => '30 user'],
            ['name' => '30 - 40 user'],
            ['name' => '60 user'],
            ['name' => '90 user'],
            ['name' => '100 user'],
            ['name' => '> 100 user'],
        ]);
    }
}
