<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TotalFee;
use Faker\Generator as Faker;

$factory->define(TotalFee::class, function (Faker $faker) {
    return [
        'cart_id' => $faker->numberBetween($min = 1, $max = 30),
        'total_fee' => $faker->numberBetween($min = 1200, $max = 99999)
    ];
});
