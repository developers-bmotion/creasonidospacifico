<?php

namespace App\Http\Controllers\Auth;

use App\Artist;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(Request $request)
    {
        /* $data = $this->validator($request)->validate(); */

        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([

            'email' => $request->get('email'),
            'picture' => '/backend/assets/app/media/img/users/perfil.jpg',
            'password' => Hash::make($request->get('password')),
        ]);
        $user->roles()->attach(['2']);

        $artist = new Artist;
        $artist->user_id = $user->id;
        $artist->save();


        auth()->loginUsingId($user->id);
        // return json_encode($data);
        $artist = Artist::where('user_id', auth()->user()->id)->first();

        if ($artist->documentType == null) {
            return redirect('/dashboard/form-register');
        } else {
            return redirect('/dashboard/profile')->with('welcome_register', 'Bienvenido, has creado tu cuenta, continua con tu registro');
        }
    }



    /*  protected function create(array $data)
     {
         $data = $this->validator($data)->validate();

         $user =  User::create([

             'email' => $data['email'],
             'picture' => '/backend/assets/app/media/img/users/perfil.jpg',
             'password' => Hash::make($data['password']),
         ]);
         $user->roles()->attach(['2']);

         $artist = new Artist;
         $artist->user_id = $user->id;
         $artist->save();


         auth()->loginUsingId($user->id);
         // return json_encode($data);

         return redirect('/dashboard/profile')->with('welcome_register', 'Bienvenido, has creado tu cuenta, continua con tu registro.');
     } */

    /* protected function registered(Request $request, $user)
    {
        Artist::create([
           'user_id' => $user->id
        ]);
        $user->roles()->attach(['2','3']);
        $data = new \stdClass();
        $data->status = 200;
        $data->url = url('/dashboard/profile');
        // return json_encode($data);
        return redirect('/dashboard/profile');
        //return redirect('/dashboard/profile');
    } */
}
