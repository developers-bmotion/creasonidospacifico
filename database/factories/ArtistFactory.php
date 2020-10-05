<?php

use Faker\Generator as Faker;

$factory->define(App\Artist::class, function (Faker $faker) {
    return [
        'user_id' => null,
        'nickname' => $faker->jobTitle,
        'biography' => $faker->text,
        'adress' => $faker->address,
        'township' => $faker->city,
        'byrthdate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'identification' =>$faker->randomNumber($nbDigits = NULL, $strict = false),
        'document_type' => 1,
        'cities_id' => \App\City::all()->random()->id,
        'expedition_place' => \App\City::all()->random()->id,
        'person_types_id' => \App\PersonType::all()->random()->id,
        'artist_types_id' => \App\ArtistType::all()->random()->id
    ];
});
