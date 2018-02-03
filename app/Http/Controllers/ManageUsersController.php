<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ManageUsersController extends Controller
{
    /**
     * Show the manage user page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manage_users')->with('users', User::all()->except(\Auth::user()->id));
    }

    public function single($id)
    {
        return view('manage_users_single')->with('user', User::findOrFail($id));
    }
}
