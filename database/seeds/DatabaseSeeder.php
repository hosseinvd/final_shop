<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
//php artisan migrate:refresh --seed
    public function run()
    {
        $this->call(LaratrustSeeder::class);
        // $this->call(UsersTableSeeder::class);
        $discount = factory(\App\Discount::class, 1)->create();

        $categories = factory(\App\Category::class, 8)->create();
        $products = factory(\App\Product::class, 10)->create();
        $address=factory(\App\Users_address::class, 24)->create();
//        $this->call(m_imagesTableSeeder::class);
        $this->call(DiscountTableSeeder::class);
        $images = factory(\App\m_image::class, 16)->create();

    }
}
