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
        return view('backend.users.users-all');
    }

    public function getUsersTable()
    {
        $users = Role::whereIn('id', [1, 3, 4])->with('users')->get();
        return datatables()->of($users)->toJson();
    }
}