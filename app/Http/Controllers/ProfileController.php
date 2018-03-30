<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Google2FA;
use Illuminate\Http\Request;

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
