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
//        $categories = factory(\App\Category::class, 2)->create();
//        $products = factory(\App\Product::class, 6)->create();
//        $images = factory(\App\m_image::class, 48)->create();

    }
}
