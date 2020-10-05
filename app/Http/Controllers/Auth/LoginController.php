<?php

namespace App\Http\Controllers\Auth;

use App\Artist;
use App\Http\Controllers\Controller;
use App\User;
use App\UserSocialAccount;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*=============================================
    MIDDLEWARE DEL CONTROLLADOR
    =============================================*/
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        return redirect('/login');
    }

    public function index()
    {
        return redirect('/login');
    }

    public function authenticated(Request $request)
    {

        $users = User::where('id', \Auth::user()->id)->with(['roles'])->first();
        $rol = array_pluck($users->roles, 'rol');
        if (in_array('Admin', $rol) || in_array('Manage', $rol) || in_array('Subsanador', $rol)) {

            if ($request->input("json") === "true") {
                return "/dashboard";
            }

            return redirect('/dashboard');
        } else {

            if ($request->input("json") === "true") {

                return "/dashboard/form-register";
            }

            $artist = Artist::where('user_id', auth()->user()->id)->first();

            if ($artist->documentType == null ) {
                return redirect('/dashboard/form-register');
            } else {

                return redirect('/dashboard/profile');
            }

        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/login');
    }


    /*=============================================
     REDIRECTTOPROVIDER ES LA FUNCION QUE RECIBE LA URL DE LA RED SOCIAL, AL INGRESAR EJECUTA LA CLASE SOCIALITE Y LE REDIRECCIONA A LA PAGINA DE LOGIN DE LA RED SOCIAL
    =============================================*/
    public function redirectToProvider(string $driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    /*=============================================
    HANDLEPROVIDERCALLBACK ES LA FUNCION QUE RECIBE LOS DATOS QUE ENVIA LA RED SOCIAL
    =============================================*/
    public function handleProviderCallback(string $driver)
    {
        //Se valida primero la ruta que nos trae la red social
        if (!request()->has('code') || request()->has('denied')) {
            session()->flash('message', ['danger', __('Inicio de sesion cancelado')]);
            return redirect(route('home'));
        }
        //Traemos todos los datos y los almacenamos en la variable $socialUser
        $socialUser = Socialite::driver($driver)->stateless()->user();
        $user = null; //Declaramos la variable user null para despues usarla y validar que los datos del usuarios son null
        $success = true; //$success es para al final del registro dar una alerta de que ha sido un exito
        $email = $socialUser->email; //$email la declaramos para almacenar el email que nos traer socialite
        $check = User::whereEmail($email)->first(); //verificamos con este metodo si el email que nos traer socialite existe en la base de datos


        if ($check) {
            $user = $check;
        } else {
            \DB::beginTransaction();

            try {   //si $check es igual a null, procedemos a registrar al usuario
                $user = User::create([
                    'name' => $socialUser->name,
                    'email' => $email,
                    'picture' => $socialUser->avatar
                ]);
                //a este usuario le asignamos los roles, Artista y Patrocinador
                $user->roles()->attach(['2', '3']);
                //Almacenamos en la base de datos el proveedor de red social con el cual el usuario ha hecho login
                UserSocialAccount::create([
                    'user_id' => $user->id,
                    'provider' => $driver,
                    'provider_uid' => $socialUser->id,
                ]);
                //Registro del artista
                Artist::create([
                    'user_id' => $user->id,
                ]);
                //Si algo del proceso sale mal, pasamos por el catch, con rollback() desacemos cualquier transaccion en la base de datos
            } catch (\Exception $exception) {
                $success = $exception->getMessage();
                \DB::rollBack();
            }

        }
        //Si es el proceso ha salido bien, iniciamos sesion al sistema
        if ($success === true) {

            \DB::commit();
            auth()->loginUsingId($user->id);
            return redirect(route('home'));
        }
        //Si el proceso no fue culminado con exito, error al iniciar sesion
        session()->flash('message', ['danger', $success]);
        return redirect(route('home'));
    }


}
