<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\CustomerEmail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerEmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \echoCLI('Seed Customer Emails...');

        Customer::all()->each(function($customer)
        {
            // Create 1-3 email contacts per customer
            $numContacts = fake()->numberBetween(1, 3);
            for($i = 1; $i <= $numContacts; $i++)
            {
                CustomerEmail::create([
                                          'customer_id' => $customer->id,
                                          'name'        => fake()->name(),
                                          'email'       => fake()->unique()->safeEmail(),
                                      ]);
            }
        });
    }
}
