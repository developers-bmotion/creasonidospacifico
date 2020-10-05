<?php

use Faker\Generator as Faker;

$factory->define(App\Review::class, function (Faker $faker) {
    $rating= mt_rand(1,5);
    return [
        'project_id' => \App\Project::all()->random()->id,
        'user_id' => \App\Project::all()->random()->id,
        'comment' => $faker->text(200),
        'rating' => $rating
    ];
});
