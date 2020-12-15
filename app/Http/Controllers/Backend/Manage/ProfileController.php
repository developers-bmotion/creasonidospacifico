<?php

namespace App\Http\Controllers\Backend\Manage;

use App\Artist;
use App\Management;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(User $user)
    {   $user = User::where('id', $user->id)->with('roles')->first();
        $managements = Management::where('user_id',$user->id)->with('categories')->first();
        return view('backend.management.profile.profile-management', compact('user','managements'));
    }

    public function my_proyects(User $user)
    {
        return view('backend.management.profile.my-projects', compact('user'));
    }

    public function table_proyects(Request $request)
    {
        $id_user = $request->input('id_user');
        $project = \App\Project::whereHas('management', function ($query) use ($id_user) {
            $query->where('managements.user_id', '=', $id_user);
        })->with('category','artists','artists.users');
        if ($request->input("tipoProyecto")){
            $project->where('status', "=", $request->input("tipoProyecto"));
        }
        return datatables()->of($project)->toJson();
    }

    public function update_profile_management(Request $request, $id)
    {

        $management = Management::where('user_id', $id)->update([
            'company' => ucfirst($request->get('company')),
            'description' => ucfirst($request->get('descripcion')),
            'website_url' =>  $request->get('web_site'),
        ]);

        alert()->success(__('perfil_actualizado'), __('muy_bien'))->autoClose(3000);
        return back();
    }

    public function update_password_management(Request $request){

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

    public function photo_management(Request $request)
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
