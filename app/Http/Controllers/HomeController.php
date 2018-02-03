<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Thread;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the home with all thrads and posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $threads = Thread::all();

        return view('home', compact('user', 'threads'));
    }

    /**
     * Show the manage user page.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {
        return view('manage_users');
    }
}
