<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

//        $this->call(UserConnect::class);
        $this->call(SpeedWifiSeeder::class);
        $this->call(ManufactureSeeder::class);
        $this->call(MadeInSeeder::class);
        $this->call(FrequencyBandSeeder::class);
        $this->call(CoverageDensitySeeder::class);
        $this->call(GuaranteeSeeder::class);
        $this->call(StandardNetworkSeeder::class);
        $this->call(TypeDeviceSeeder::class);
        $this->call(TypeAnteingSeeder::class);
        $this->call(ButtonSupportSeeder::class);
        $this->call(PortSeeder::class);
        $this->call(PromotionSeeder::class);
        $this->call(AnteingSeeder::class);
    }
}
