<?php

use Faker\Generator as Faker;

$factory->define(App\m_image::class, function (Faker $faker) {
    return [
        'imagePath'=>$faker->image('public/product_image',$width = 640, $height = 480,null,false),
        'product_id' => $faker->randomElement(\App\Product::pluck('id')->toArray()),
        'imageSize'=>'640'
    ];
});
