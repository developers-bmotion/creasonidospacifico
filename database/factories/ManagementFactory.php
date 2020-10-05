<?php

use Faker\Generator as Faker;

$factory->define(App\Management::class, function (Faker $faker) {
    return [
        'user_id' => null,
        /*'company' => $faker->jobTitle,
        'description' => $faker->paragraph,
        'website_url' => $faker->url,
        'country_id' => \App\Country::all()->random()->id*/
    ];
});
