<?php

namespace Database\Seeders;

use App\Models\Link;
use App\Models\LinkProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinkProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LinkProduct::factory(10)->create();
    }
}
