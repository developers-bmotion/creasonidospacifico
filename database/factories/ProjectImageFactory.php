<?php

use Faker\Generator as Faker;

$factory->define(App\ProjectImage::class, function (Faker $faker) {

    return [
        'project_id' => \App\Project::all()->random()->id,
        'url' => \Faker\Provider\Image::image(storage_path() . '/app/public/projects_images',670,460,'fashion',false)
    ];
});
