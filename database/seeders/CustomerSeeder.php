<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \echoCLI('Seed Customers...');;
        // Create active customers
        Customer::factory()->count(10)->create()
            /** @var Customer $customer */
                ->each(function($customer)
            {
                // Create a login name
                $name = Str::of($customer->first_name.' '.$customer->last_name)
                           ->replaceMatches('/[^A-Za-z0-9]+/u', '')->camel()->ucfirst();

                // Create a user for each customer
                /** @var User $user */
                $user = User::create([
                                         'name'     => $name,
                                         'email'    => fake()->unique()->safeEmail(),
                                         'password' => Hash::make('password'),
                                     ]);

                // Verify the user's email
                $user->email_verified_at = now();
                $user->save();

                // Assign 'customer' Role
                $user->assignRole('customer');

                // Attach the user to the customer
                $customer->update(['user_id' => $user->id]);

                // Create address
                $address = Address::factory()->create();
                // Seed Customers all in Australia
                $address->update(['address_to' => $customer->fullName(), 'country_id' => 1]);
                $customer->update(['address_id' => $address->id]);

                // Assign account manager
                $accountManagerUser = User::role('account_manager')->inRandomOrder()->first();
                $customer->assignAccountManager($accountManagerUser);
            });
    }
}
