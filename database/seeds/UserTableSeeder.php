<?php

use Illuminate\Database\Seeder;
use App\User;
use \App\Management;
use  \App\Artist;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         User::truncate();
         Management::truncate();
         Artist::truncate();
        $admin = User::create([

            'name'=>'Admin',
            'last_name'=>'Admin',
            'picture'=>'/backend/assets/app/media/img/users/perfil.jpg',
            'front_picture'=>'/backend/assets/app/media/img/users/perfil.jpg',
            'phone_1'=>'333333333',
            'phone_2'=>'333333333',
            'state'=>'1',
            'slug'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('secret')

        ]);

        $admin->roles()->attach(['1']);

        $curador = User::create([

            'name'=>'Curador',
            'last_name'=>'curador',
            'picture'=>'/backend/assets/app/media/img/users/perfil.jpg',
            'phone_1'=>'333333333',
            'phone_2'=>'333333333',
            'state'=>'1',
            'slug'=>'curador',
            'email'=>'curador@gmail.com',
            'password'=>bcrypt('secret')

        ]);

        $curador->roles()->attach(['3']);
        $add_management = Management::create([
            'user_id' => $curador->id,
            'country_id' => '1'
        ]);

        $add_management->categories()->attach(['2','3']);

        $aspirante = User::create([

            'name'=>'Aspirante',
            'last_name'=>'aspirante',
            'picture'=>'/backend/assets/app/media/img/users/perfil.jpg',
            'phone_1'=>'333333333',
            'phone_2'=>'333333333',
            'state'=>'1',
            'slug'=>'aspirante',
            'email'=>'aspirante@gmail.com',
            'password'=>bcrypt('secret')
        ]);

        $aspirante->roles()->attach(['2','3']);
        $aspirant = new Artist;
        $aspirant->user_id = $aspirante->id;
        $aspirant->save();


        $subsanador = User::create([

            'name'=>'Subsanador',
            'last_name'=>'subsanador',
            'picture'=>'/backend/assets/app/media/img/users/perfil.jpg',
            'front_picture'=>'/backend/assets/app/media/img/users/perfil.jpg',
            'phone_1'=>'333333333',
            'phone_2'=>'333333333',
            'state'=>'1',
            'slug'=>'subsanador',
            'email'=>'subsanador@gmail.com',
            'password'=>bcrypt('secret')

        ]);

        $subsanador->roles()->attach(['4']);

        $curadorP = User::create([

            'name'=>'Curador',
            'last_name'=>'principal',
            'picture'=>'/backend/assets/app/media/img/users/perfil.jpg',
            'front_picture'=>'/backend/assets/app/media/img/users/perfil.jpg',
            'phone_1'=>'333333333',
            'phone_2'=>'333333333',
            'state'=>'1',
            'slug'=>'curador_principal',
            'email'=>'curador_principal@gmail.com',
            'password'=>bcrypt('secret')

        ]);

        $curadorP->roles()->attach(['5']);


    }
}
