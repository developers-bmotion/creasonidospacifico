<?php

use Faker\Generator as Faker;

$factory->define(App\PersonType::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->word,
    ];
});
