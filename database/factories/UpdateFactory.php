<?php

use Faker\Generator as Faker;

$factory->define(App\Update::class, function (Faker $faker) {
    return [
        'title' => $faker->jobTitle,
        'project_id' => \App\Project::all()->random()->id,
        'description' => $faker->sentence,
        'media' => \Faker\Provider\Image::image(storage_path() . '/app/public/projects', 600,350,'business', false),

    ];
});
