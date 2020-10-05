<?php

use Faker\Generator as Faker;

$factory->define(App\Donation::class, function (Faker $faker) {
    return [
        'amount' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
        'project_id' => \App\Project::all()->random()->id,
        'user_id' => \App\User::all()->random()->id

    ];
});
