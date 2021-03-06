<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */

    protected $redirectTo = '/dashboard/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected function redirectTo()
    {
        if (auth()->user()->roles[0]->rol == "Gestor") {
            return '/dashboard/profile-gestor/' . auth()->user()->slug;
        } else if (auth()->user()->roles[0]->rol == "Artist") {
            return '/dashboard/profile';
        } else if (auth()->user()->roles[0]->rol == "Manage"){
            return '/dashboard/profile-managament/' . auth()->user()->slug;
        }else{
            return '/dashboard';
        }
    }

    public function __construct()
    {

        $this->middleware('guest');
    }

}
