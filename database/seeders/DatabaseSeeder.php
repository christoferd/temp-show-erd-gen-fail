<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // -------------------------------------
        \echoCLI('Seed TradeTerm Data...');
        $options = explode('/', 'FIS/FOB/CIF/CFR/DAP/DDU');
        foreach($options as $option) {
            // create a new trade term
            (new \App\Models\TradeTerm(['name' => $option]))->save();
        }

        // -------------------------------------
        \echoCLI('Seed PaymentTerm Data...');
        $options = explode('/', 'COD/DEPOSIT/NET 14 DAYS/NET 30 DAYS/NET 90 DAYS');
        foreach($options as $option) {
            // create a new payment term
            (new \App\Models\PaymentTerm(['name' => $option]))->save();
        }

        $this->call(CitySeeder::class);
        $this->call(StateSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(StaffSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(CustomerEmailSeeder::class);

        if(!\isProduction())
        {
            $this->call(DemoDataSeeder::class);
        }
    }
}
