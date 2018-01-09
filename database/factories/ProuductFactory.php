<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'title' => $faker->company,
        'description' => $faker->realText($maxNbChars = 150, $indexSize = 1) ,
        'viewCount'=>0,
        'price' => rand(10,100),
        'discount'=>rand(5,25),
        'inventory'=>rand(0,100),
        'warranty'=>'shop',
        'color'=>$faker->colorName,
        'weight'=>rand(1,100),
        'size'=>rand(1,50),
//        'category_id' => $faker->randomElement(\App\Category::pluck('id')->toArray())
    ];
});
