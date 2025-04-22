<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::factory()->create([
            'id' => 1,
            'code' =>'ORD-0001',
            'transaction_id' => 'TRX-0001',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'jon@email.com',
            'user_id' => 1,
            'ambassador_email' => 'doe@email.com',
            'address' => '123 Main St',
            'city' => 'New York',
            'country' => 'USA',
            'zip' => '10001',
            'created_at' => '2023-01-01 00:00:00',
            'updated_at' => '2023-01-01 00:00:00',
        ]);
        Order::factory(
            count: 3,
        )->create();
    }
}
