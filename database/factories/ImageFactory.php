<?php

use Faker\Generator as Faker;

$factory->define(App\m_image::class, function (Faker $faker) {
    return [
        'imagePath'=>$faker->image('public/product_image',$width = 960, $height = 720,'food',false),
        'product_id' => $faker->randomElement(\App\Product::pluck('id')->toArray()),
        'imageSize'=>'960'
    ];
});
