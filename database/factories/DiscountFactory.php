<?php

use Faker\Generator as Faker;

$factory->define(App\Discount::class, function (Faker $faker) {
    return [
        'code' => 'null_discount',
        'type' => 'admin',
        'calc_mode'=>'MAX',
        'percent'=>0,
        'value' => 0,
        'numbers'=>0,
        'start_date'=>$faker->dateTime('now'),
        'end_date'=>$faker->dateTime('2099-04-25 08:37:17'),
        'user_id'=>$faker->randomElement(\App\User::pluck('id')->toArray()),
    ];
});
