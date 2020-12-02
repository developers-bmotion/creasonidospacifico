<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewGestorAdmin;
use App\Mail\NewSubsanadorAdmin;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('backend.users.users-all', compact('roles'));
    }

    public function getUsersTable()
    {
        $users = User::whereHas('roles', function($q){
            $q->where('role_idRole', 1)->orWhere('role_idRole', 3)->orWhere('role_idRole', 4);
        })->with('roles');
        return datatables()->of($users)->toJson();
    }

    public function storeUsers(Request $request){

        $this->validate($request,[
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required',
            'document_type' => 'required',
            'identificacion' => 'required',
            'role_type' => 'required',
        ]);
        $password = trim(str_random(8));
        $pass = bcrypt($password);

        $add_user = User::create([
            'name' => ucwords($request->get('name')),
            'last_name' => ucwords($request->get('last_name')),
            'picture' => '/backend/assets/app/media/img/users/perfil.jpg',
            'document_type' => $request->document_type,
            'profile' => $request->profile,
            'identification' => $request->identificacion,
            'email' => $request->get('email'),
            'password' => $pass,
            'phone_1' => $request->get('phone'),
            'slug' => Str::slug($request->get('name').'-'.(1000),'-')
        ]);
        $add_user->roles()->attach($request->role_type);
        if ($request->role_type == 4){
            \Mail::to($add_user->email)->send(new NewSubsanadorAdmin($add_user->email,$password));
            return back()->with('msg', ['¡Registro Exitoso!', 'El subsanador ha sido registrado en el sistema', 'success']);
        }


    }
}
