<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory
 */
class MerchSaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->userName(),
            'item' => fake()->sentence(2),
            'quantity' => fake()->numberBetween(1, 10),
            'price' => fake()->randomFloat(null, 10, 200),
            'created_at' => fake()->dateTimeBetween('-3 months'),
        ];
    }
}
