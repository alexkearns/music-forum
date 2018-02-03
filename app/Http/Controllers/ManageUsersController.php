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

    public function singleSave($id, Request $request)
    {
        $user = User::findOrFail($id);
        $admin = \Auth::user()->can('assign-admin') ? $request->filled('admin') : $user->isA('admin');
        $mod = \Auth::user()->can('assign-moderator') ? $request->filled('mod') : $user->isA('moderator');
        $ban = \Auth::user()->can('ban-user') ? $request->filled('ban') : $user->banned;

        $admin ? $user->assign('admin') : $user->retract('admin');
        $mod ? $user->assign('moderator') : $user->retract('moderator');
        $user->banned = $ban;
        $user->save();

        return redirect()->back();
    }
}
