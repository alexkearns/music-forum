<?php

namespace App\Http\Controllers;

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
        return view('manage_users');
    }
}
