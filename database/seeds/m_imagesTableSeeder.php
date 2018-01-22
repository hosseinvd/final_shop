<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class m_imagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        for ($i=1; $i < 24; $i++) {
            DB::table('m_images')->insert([
                'imagePath' => $faker->image('public/product_image', $width = 960, $height = 720, 'abstract', false),
                'product_id' => $i%8+1,
                'imageSize' => '960'
            ]);
        }
    }
}
