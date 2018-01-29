<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DiscountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        DB::table('discounts')->insert([
        'code' => 'HVD',
        'type' => 'reseller_Discount',
        'calc_mode'=>'MIN',
        'commission'=>10,
        'percent'=>10,
        'value' => 25,
        'numbers'=>10000,
        'start_date'=>$faker->dateTime('now'),
        'end_date'=>$faker->dateTime('2099-04-25 08:37:17'),
        'user_id'=>2]);
    }
}
