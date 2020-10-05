<?php

namespace App\Http\Controllers\Backend\Manage;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BackingsMadeController extends Controller
{
    public function index(User $user){

        return view('backend.management.profile.backings-made',compact('user'));
    }
}
