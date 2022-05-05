<?php

/** @var Factory $factory */

use App\Product;
use App\Tag;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'tag_id' => $faker->numberBetween($min = 1, $max = 10),
        'type_id' => $faker->numberBetween($min = 1, $max = 10),
        'name' => $faker->unique()->country,
        'price' => $faker->numberBetween($min = 1000, $max = 10000),
        'image' => $faker->image,
        'description' => $faker->text,
        'stock' => $faker->numberBetween($min = 0, $max = 500),
    ];
});
