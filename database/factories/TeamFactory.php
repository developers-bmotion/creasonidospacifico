<?php

use Faker\Generator as Faker;

$factory->define(App\Team::class, function (Faker $faker) {
    return [
            'name'=> $faker->name,
            'last_name'=> $faker->name,
            'document_type'=> 1,
            'identification'=>$faker->randomNumber($nbDigits = NULL, $strict = false),
            'expedition_place'=>\App\City::all()->random()->id,
            'birthday'=>$faker->date($format = 'Y-m-d', $max = 'now'),
            'email'=>$faker->unique()->safeEmail,
            'addres'=>$faker->address,
            'phone1'=>'312 312312312',
            'phone2'=>'312 312312312',
            'artist_id' => \App\Artist::all()->random(),
            'pdf_identificacion'=>'/storage/pdfidentificacion/prueba.pdf',
            'role'=>'Instrumento',

    ];
});
