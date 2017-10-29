<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function users()
    {
        $users = \App\User::paginate(3);

        return view('users')->with('users', $users);
    }
}
