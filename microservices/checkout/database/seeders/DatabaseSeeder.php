<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Link;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
        Product::factory()->create([
            'id' => 1,
            'title' => 'Product 1',
            'price' => 100,
        ]);

        Link::factory()->create([
            'id' => 1,
            'code' => 'Link 1',
        ]);

        $this->call([
            LinkSeeder::class,
            ProductSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
            LinkProductSeeder::class,
        ]);
    }
}
