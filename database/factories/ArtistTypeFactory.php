<?php

use Faker\Generator as Faker;

$factory->define(App\ArtistType::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
