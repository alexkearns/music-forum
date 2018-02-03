<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Thread;
use App\Post;

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
     * Show a specific threads posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function showThreadPosts(Thread $thread)
    {
        $user = Auth::user();
        $posts = $thread->getPosts();

        return view('thread', compact('user', 'thread', 'posts'));
    }

    /**
     * Save a newly created post.
     *
     * @return Redirect
     */
    public function newPost(Request $request)
    {
        $user = Auth::user();
        $thread = Thread::find($request->thread_id);

        $posts = $thread->getPosts();

        Post::create([
            'content' => $request->content,
            'thread_id' => $request->thread_id,
            'user_id' => $user->id
        ]);

        flash('Post successfully added!')->success();

        return redirect()->route('thread', compact('user', 'thread', 'posts'));
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
