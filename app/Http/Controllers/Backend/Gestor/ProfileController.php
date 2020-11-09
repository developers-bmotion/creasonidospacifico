<?php

namespace App\Http\Controllers\Backend\Gestor;

use App\Artist;
use App\Management;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        $userProfile = User::where('id', $user->id)->with('documentType', 'city.departaments', 'roles')->first();
        return view('backend.gestores.profile.profile-gestores', compact('userProfile'));
    }


    public function update_password_gestor(Request $request){

        if ($request->filled('password')) {

            $this->validate($request, [

                'password' => 'confirmed|min:6',

            ]);
            $password = $request->get('password');
            $newpassword = bcrypt($password);

            $user = User::where('id',auth()->user()->id)->update([
                'password' => $newpassword
            ]);

            alert()->success(__('password_actualizado'),__('muy_bien'))->autoClose(3000);
            return back();
        } else {


            return back()->with('eliminar','Ningún Cambio');
        }
    }

    public function photo_gestor(Request $request)
    {   $id_user = $request->get('id_user');
        $user = User::where('id', $id_user)->first();
        $user_picture = str_replace('storage', '', $user->picture);;
        //Elimnar foto de perfil del servidor
        Storage::delete($user_picture);
        //Agregar la nueva foto de perfil
        $photo = $request->file('photo')->store('users');
        User::where('id', $id_user)->update([
            'picture' => '/storage/' . $photo,
        ]);

        return $user_picture;

    }
}
