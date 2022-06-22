<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $quantity = max($this->command->ask('Quantity of generated products: ', 20), 1);
        Product::factory($quantity)->create();
    }
}
