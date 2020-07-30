<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => substr($faker->sentence(3), 0, -1),
        'descripcion' => $faker->sentence(10),
        'long_descripcion' => $faker->text,
        'price' => $faker->randomFloat(2, 5, 150),
        'category_id' => $faker->numberBetween(1, 5)
    ];
});
