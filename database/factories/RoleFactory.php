<?php

use Faker\Generator as Faker;

$factory->define(App\Role::class, function (Faker $faker) {
    return [
        'rol' => $faker->word,
        'description' => $faker->sentence
    ];
});
