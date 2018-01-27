<?php

use Faker\Generator as Faker;

$factory->define(App\m_image::class, function (Faker $faker) {
    return [
        'imagePath'=>$faker->image('public/product_image',$width = 800, $height = 600,false,false, true),
        'product_id' => $faker->randomElement(\App\Product::pluck('id')->toArray()),
        'imageSize'=>'960'
    ];
});


//category:'abstract', 'animals', 'business', 'cats', 'city', 'food', 'nightlife',
//        'fashion', 'people', 'nature', 'sports', 'technics', 'transport'