<?php

use Faker\Generator as Faker;

$factory->define(App\Users_address::class, function (Faker $faker) {
    return [
        'name_family' => $faker->name(),
        'phone_number' => $faker->phoneNumber,
        'mobile_number'=>$faker->phoneNumber,
        'country' => 'iran',
        'province'=>'isfahan',
        'city'=>'isfahan',
        'address'=>$faker->address,
        'postal_code'=>$faker->postcode,
        'email'=>$faker->email,
        'user_id'=>$faker->randomElement(\App\User::pluck('id')->toArray()),
    ];
});
