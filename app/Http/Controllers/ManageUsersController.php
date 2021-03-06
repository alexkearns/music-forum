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
    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        $perPage = 10;

        $users = User::orderBy('name')->get()->except(\Auth::user()->id);
        $users = new \Illuminate\Pagination\LengthAwarePaginator(
            $users->forPage($page, $perPage),
            $users->count(),
            $perPage,
            $page
        );
        $users = $users->withPath('users');
        return view('manage_users')->with('users', $users);
    }

    public function single($id)
    {
        return view('manage_users_single')->with('user', User::findOrFail($id));
    }

    public function singleSave($id, Request $request)
    {
        $user = User::findOrFail($id);

        /* If user has permission to do the task, take the value from the request, if not revert to the user
         * being edited's current role. */
        $admin = \Auth::user()->can('assign-admin') ? $request->filled('admin') : $user->isA('admin');
        $mod = \Auth::user()->can('assign-moderator') ? $request->filled('mod') : $user->isA('moderator');
        $ban = \Auth::user()->can('ban-user') ? $request->filled('ban') : $user->banned;

        $admin ? $user->assign('admin') : $user->retract('admin');
        $mod ? $user->assign('moderator') : $user->retract('moderator');
        $user->banned = $ban;
        $user->save();

        flash('User updated!')->success();
        return redirect()->back();
    }
}
