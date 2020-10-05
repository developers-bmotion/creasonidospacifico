<?php

use Faker\Generator as Faker;

$factory->define(App\DocumentType::class, function (Faker $faker) {
    return [
        'document' => $faker->sentence,
        'description' => $faker->sentence
    ];
});
