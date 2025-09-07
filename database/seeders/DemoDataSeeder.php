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

        $this->call(FactorySeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(CustomerEmailSeeder::class);

        \echoCLI('**** DemoDataSeeder Complete!');
    }
}
