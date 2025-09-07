<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address_to'       => fake()->company(),
            'street1'  => fake()->streetAddress(),
            'street2'  => fake()->secondaryAddress(),
            'city_id'          => City::inRandomOrder()->first()->id,
            'state_id'         => State::inRandomOrder()->first()->id,
            'country_id'       => Country::inRandomOrder()->first()->id,
            'postcode' => fake()->numberBetween(1000, 9999),
        ];
    }
}
