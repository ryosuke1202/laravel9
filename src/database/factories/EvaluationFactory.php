<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Evaluation;
use App\Product;
use App\User;
use Faker\Generator as Faker;

$factory->define(Evaluation::class, function (Faker $faker) {
    return [
        'product_id' => $faker->numberBetween($min = 1, $max = 30),
        'user_id' => $faker->numberBetween($min = 1, $max = 20),
        'title' => $faker->word,
        'evaluate' => $faker->text,
        'star' => $faker->numberBetween($min = 1, $max = 5),
    ];
});
