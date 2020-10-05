<?php

use Faker\Generator as Faker;

$factory->define(App\Reward::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'project_id' => \App\Project::all()->random()->id,
        'description' => $faker->sentence,
        'estimated' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'shipments' => "Envios a America Latina",
        'price' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
    ];
});
