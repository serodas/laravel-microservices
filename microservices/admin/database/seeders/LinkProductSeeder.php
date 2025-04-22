<?php

namespace Database\Seeders;

use App\Models\LinkProduct;
use Illuminate\Database\Seeder;

class LinkProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LinkProduct::factory(
            count: 3,
        )->create();
    }
}
