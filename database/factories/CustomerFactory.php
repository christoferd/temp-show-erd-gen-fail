<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\PaymentTerm;
use App\Models\State;
use App\Models\TradeTerm;
use App\Models\User;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $company = fake()->company();

        return [
            // abn
            'abn'                     => fake()->numberBetween(10000000000, 99999999999),
            'company_name'            => $company,
            'first_name'              => fake()->firstName(),
            'last_name'               => fake()->lastName(),
            'phone_1'                 => fake()->phoneNumber(),
            // second phone number only 50% of the time
            'phone_2'                 => (fake()->optional()->phoneNumber() ?: ''),
            'website'                 => (fake()->optional()->url() ?: ''),
            // set account manager to a random user that has the role 'account_manager'
            'account_manager_user_id' => User::role('account_manager')->inRandomOrder()->first()?->id,
            'brand_label'             => $company,
            'trade_term_id'           => TradeTerm::inRandomOrder()->first()?->id,
            'payment_term_id'         => PaymentTerm::inRandomOrder()->first()?->id,
            'address_id'              => null,
            'shipping_addresses'      => null, // todo add 1 to 3 fake shipping addresses
            'is_active'               => true,
        ];
    }
}
