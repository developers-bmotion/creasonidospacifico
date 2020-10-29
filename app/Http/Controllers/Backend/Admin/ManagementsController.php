<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Category;
use App\Country;
use App\Mail\NewGestorAdmin;
use App\Mail\NewManagerAdmin;
use App\Management;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class ManagementsController extends Controller
{
    public function index(){

        $managements = Management::where('tipoCurador', '=' , 1)->with('users')->paginate(6);
        $managementstwo = Management::where('tipoCurador', '=' , 2)->with('users')->paginate(6);
        // $managements = Management::with('users')->paginate(6);
        // $countries = Country::all();
        $categories = Category::all();
        // return view('backend.admin.management-admin',compact('managements','countries','categories'));
        return view('backend.admin.management-admin',compact('managements','managementstwo','categories'));
    }

//    AQUI TRAEMOS LA VISTA TODOS LOS GESTORES
    public function gestores(){
        $departamentos = Country::all();
        $gestores = User::whereHas('roles', function ($query){
            $query->where('role_idRole', 6);
        })->get();

        return view('backend.admin.gestores-admin', compact('gestores', 'departamentos'));
    }

    public function storeGestores(Request $request){

        $this->validate($request,[
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required',
            'document_type' => 'required',
            'identificacion' => 'required',
            'city' => 'required',
        ]);

        $password = trim(str_random(8));
        $pass = bcrypt($password);
        $add_user = User::create([
            'name' => ucwords($request->get('name')),
            'last_name' => ucwords($request->get('last_name')),
            'picture' => '/backend/assets/app/media/img/users/perfil.jpg',
            'document_type' => $request->document_type,
            'id_city' => $request->city,
            'profile' => $request->profile,
            'identification' => $request->identificacion,
            'email' => $request->get('email'),
            'password' => $pass,
            'phone_1' => $request->get('phone'),
            'slug' => Str::slug($request->get('name').'-'.str_random(1000),'-')
        ]);
        $add_user->roles()->attach('6');
        \Mail::to($add_user->email)->send(new NewGestorAdmin($add_user->email,$password));
        return back()->with('msg', ['¡Registro Exitoso!', 'El gestor ha sido registrado en el sistema', 'success']);
    }

    public function store(Request $request){

        // dd($request->get('tipoCurador'));
        $this->validate($request,[
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'tipoCurador' => 'required',
         ]);
            // dd($request);
        $password = trim(str_random(8));
        $pass = bcrypt($password);
        $add_user = User::create([
            'name' => ucwords($request->get('name')),
            'last_name' => ucwords($request->get('last_name')),
            'picture' => '/backend/assets/app/media/img/users/perfil.jpg',
            'email' => $request->get('email'),
            'password' => $pass
        ]);

        \Mail::to($add_user->email)->send(new NewManagerAdmin($add_user->email,$password));
        $add_management = Management::create([
            'user_id' => $add_user->id,
            'tipoCurador' => $request->get('tipoCurador')
        ]);
        // dd($add_management);
        $add_user->roles()->attach(['4']);
        $add_management->categories()->attach($request->get('insteres'));

        //alert()->success(,__('managementCreatedTitle'))->autoClose(10000);
        return back()->with('msg', [__('managementCreatedTitle'), __('managementCreated'), 'success']);
    }
}
