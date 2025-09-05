<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Factory>
 */
class FactoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_english' => fake()->company(),
            'name_china' => fake()->company() . ' 有限公司',
            'phone_1' => fake()->phoneNumber(),
            'phone_2' => fake()->optional()->phoneNumber()?:'',
            'email' => fake()->unique()->safeEmail(),
            'website' => fake()->optional()->url()?:'',
            'address_to' => fake()->optional()->name()?:'',
            'address_street1' => fake()->streetAddress(),
            'address_street2' => fake()->optional()->secondaryAddress()?:'',
            'city_id'          => City::inRandomOrder()->first()?->id,
            'state_id'         => State::inRandomOrder()->first()?->id,
            'country_id'       => 2,
            'address_postcode' => fake()->postcode(),
            'active' => fake()->boolean(85), // 85% chance of being active
        ];
    }

    /**
     * Indicate that the factory should be inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'active' => false,
        ]);
    }

    /**
     * Indicate that the factory should be active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'active' => true,
        ]);
    }
}
