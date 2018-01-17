<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LaratrustSeeder::class);
        // $this->call(UsersTableSeeder::class);
        $discount = factory(\App\Discount::class, 1)->create();
        $categories = factory(\App\Category::class, 2)->create();
        $products = factory(\App\Product::class, 8)->create();
        $address=factory(\App\Users_address::class, 16)->create();
        $images = factory(\App\m_image::class, 48)->create();

    }
}
