<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Blog;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker) {
    return [
        'product_id' => $faker->numberBetween($min = 1, $max = 30),
        'user_id' => $faker->numberBetween($min = 1, $max = 20),
        'title' => $faker->word,
        'content' => $faker->text,
    ];
});
