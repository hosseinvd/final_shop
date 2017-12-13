<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *php artisan db:seed --class=ProductTableSeeder
     * @return void
     */
    public function run()
    {
        $products = factory(\App\Product::class, 12)->create();
    }
}
