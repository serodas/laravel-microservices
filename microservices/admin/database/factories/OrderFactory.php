<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->randomNumber(),
            'code' => $this->faker->word(),
            'transaction_id' => $this->faker->unique()->randomNumber(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'user_id' => $this->faker->randomNumber(),
            'ambassador_email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'zip' => $this->faker->postcode(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
