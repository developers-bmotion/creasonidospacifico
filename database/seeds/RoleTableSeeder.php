<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        Role::create([
            'rol'=>'Admin',
            'description'=>'rol del administrador tiene todos los permisos'
        ]);

        Role::create([
            'rol'=>'Artist',
            'description'=>'Ver sus datos, editarlos y subir sus piezas para el concurso '
        ]);

        Role::create([
            'rol'=>'Curador',
            'description'=>'Revisar las piezas musicales y calificarlas'
        ]);

        Role::create([
            'rol'=>'Subsanador',
            'description'=>'Revisar que los datos del aspirante esten en orden y asignar las piezas a los curadores'
        ]);
        Role::create([
            'rol'=>'Curador Principal',
            'description'=>'Encargado de elegir los ganadores'
        ]);

    }
}
