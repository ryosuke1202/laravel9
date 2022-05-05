<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cart;
use Faker\Generator as Faker;
use App\Product;
use App\User;

$factory->define(Cart::class, function (Faker $faker) {
    return [
        'product_id' => $faker->numberBetween($min = 1, $max = 30),
        'quantity' => $faker->numberBetween($min = 1, $max = 20),
        'user_id' => $faker->numberBetween($min = 1, $max = 10),
        'order_number' => $faker->uuid,
        'type_id' => $faker->numberBetween($min = 1, $max = 10),
        'status_id' => $faker->numberBetween($min = 1, $max = 4),
    ];
});
