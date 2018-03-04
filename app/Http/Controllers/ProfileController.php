<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class ProfileController extends Controller
{
    /**
     * Show a users profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $profile)
    {
        return view('profile', compact('profile'));
    }
}
