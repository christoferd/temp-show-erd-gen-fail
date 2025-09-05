<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\Factory;
use App\Models\Staff;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \echoCLI('======= DemoDataSeeder =======');;

        \echoCLI('Factory Demo Data...');

        // Create some demo factories using the Factory factory
        Factory::factory()->count(2)->create();

        $this->call(CustomerSeeder::class);
        $this->call(CustomerEmailSeeder::class);

        \echoCLI('**** DemoDataSeeder Complete!');
    }
}
