<?php

use App\PersonType;
use Illuminate\Database\Seeder;

class PersonTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PersonType::truncate();

        $personType = new PersonType();
        $personType->name = "Persona natural";
        $personType->save();

        $personType = new PersonType();
        $personType->name = "Representante de un menor de edad";
        $personType->save();


        $personType = new PersonType();
        $personType->name = "Grupo constituido";
        $personType->save();

        // $personType = new PersonType();
        // $personType->name = "Persona jurídica";
        // $personType->save();
    }
}
