<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeAnteingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_anteing')->insert([
            ['name' => 'ăng ten ngoài'],
            ['name' => 'ăng ten ngầm'],
            ['name' => 'ăng ten 5dbi'],
            ['name' => 'ăng ten 6dBi'],
        ]);
    }
}
