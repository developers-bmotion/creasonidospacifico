<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    $name = $faker->name;
    $last_name = $faker->lastName;
    /*  $state = $faker->randomElement([\App\User::ACTIVE, \App\User::INACTIVE]); */
    return [
        'name' => $name,
        'last_name' => $last_name,
        'second_last_name' => $last_name,
        'slug' => str_slug($name . " " . $last_name, '-'),
        'state' => \App\User::ACTIVE,
        'email' => $faker->unique()->safeEmail,
        'phone_1' => '312 312312312',
        'password' => bcrypt('secret'), // secret
        'remember_token' => str_random(10),
        'pdf_cedula' => '/storage/pdfidentificacion/prueba.pdf',
        'picture' => \Faker\Provider\Image::image(storage_path() . '/app/public/users', 200, 200, 'people', false)
    ];
});
