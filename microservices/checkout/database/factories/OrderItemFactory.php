<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
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
            'order_id' => Order::factory()->create()->id,
            'product_title' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'quantity' => $this->faker->numberBetween(1, 10),
            'ambassador_revenue' => $this->faker->randomFloat(2, 0, 50),
            'admin_revenue' => $this->faker->randomFloat(2, 0, 50),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
