<?php

use Faker\Generator as Faker;

$factory->define(App\Level::class, function (Faker $faker) {
    return [
        'level' => $faker->sentence,
        'description' => $faker->sentence
    ];
});
