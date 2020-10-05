<?php

use Faker\Generator as Faker;

$factory->define(App\Beneficiary::class, function (Faker $faker) {
    $name = $faker->name;
    $last_name = $faker->lastName;
    /*  $state = $faker->randomElement([\App\User::ACTIVE, \App\User::INACTIVE]); */
    return [
        'document_type' => 2,
        'identification' =>$faker->randomNumber($nbDigits = NULL, $strict = false),
        'name' => $name,
        'last_name' => $last_name,
        'second_last_name' => $last_name,
        'phone' => '312 312312312',
        'adress' => $faker->address,
        'biography' => $faker->text,
        'picture' => \Faker\Provider\Image::image(storage_path() . '/app/public/users', 200, 200, 'people', false),
        'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'cities_id' => \App\City::all()->random()->id,
        'township' => $faker->city,
        'expedition_place' => \App\City::all()->random()->id,
        'artist_id' => \App\Artist::all()->random()
    ];
});
