<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('backend.users.users-all', compact('roles'));
    }

    public function getUsersTable()
    {
        $users = Role::whereIn('id', [1, 3, 4])->with('users')->get();
        return datatables()->of($users)->toJson();
    }

    public function storeUsers(Request $request){
        return $request;
    }
}
