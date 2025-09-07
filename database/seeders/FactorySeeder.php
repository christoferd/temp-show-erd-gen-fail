<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Factory;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \echoCLI('Factory Demo Data...');

        // Create some demo factories
        Factory::factory()->count(3)->create()
            /** @var Factory $factory */
               ->each(function($factory)
            {
                // Create address
                $address = Address::factory()->create();
                $factory->update(['address_id' => $address->id]);
            });

        \echoCLI('Assign a random Factory to Staff that have the "factory" role...');

        User::role('factory')->inRandomOrder()->each(function($user)
        {
            /** @var User $user */
            /** @var Staff $user->staff */
            $user->staff->update(['factory_id' => Factory::inRandomOrder()->first()->id]);
        });
    }
}
