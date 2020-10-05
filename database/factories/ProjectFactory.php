<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    $title = $faker->sentence;
//    $status = $faker->randomElement([\App\Project::ACEPTED, \App\Project::PENDING, \App\Project::REVISION, \App\Project::PREAPPROVAL,\App\Project::APPROVAL,\App\Project::REJECTED, \App\Project::REVISON_UPDATE]);
    return [
        'category_id' => \App\Category::all()->random()->id,
        'title' => $title,
        'slug' => str_slug($title.'-'.$faker->numberBetween($max = 10000),'-'),
//        'price' => $faker->randomFloat($nbMaxDecimals = 0, $min = 1000, $max = 10000),
        'description' => $faker->text(1500),
        'short_description' => $faker->sentence,
        'audio' => '/storage/music/audio.mp3',
//        'project_picture' => \Faker\Provider\Image::image(storage_path() . '/app/public/projects', 370,240,'fashion', false),
        'status' => 1,
        'author' => $faker->name,
    ];
});
