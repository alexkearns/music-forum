<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
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
        $threads = Thread::Latest()->paginate(15);

        return view('home', compact('user', 'threads'));
    }

    /**
     * Show the new thread form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showNewThreadForm()
    {
        $user = Auth::user();

        return view('new_thread', compact('user'));
    }

    /**
     * Save a newly created thread.
     *
     * @return Redirect
     */
    public function saveNewThread(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'title' => ['required', 'max:64'],
        ]);

        Thread::create([
            'title' => $request->title,
            'user_id' => $user->id
        ]);

        flash('Thread successfully added!')->success();

        return redirect()->route('home');
    }

    /**
     * Delete a thread.
     *
     * @return Redirect - route back with flash message.
     */
    public function deleteThread(Thread $thread)
    {
        $user = Auth::user();

        if ($user->can('delete-any-thread') || ($user->createdThread($thread))) {
            $thread->delete();

            flash('Thread Successfully Deleted!')->success();
        } else {
            flash('Thread Could Not Be Deleted!')->error();
        }

        return redirect()->back();
    }

    /**
     * Show a specific threads posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function showThreadPosts(Thread $thread)
    {
        $user = Auth::user();
        $posts = $thread->posts()->paginate(10);

        return view('thread', compact('user', 'thread', 'posts'));
    }

    /**
     * Save a newly created post.
     *
     * Raw SQL queries are used within this function to show understanding on
     * how to prevent SQL injection, and how laravel does it across the rest
     * of the application.
     *
     * @return Redirect
     */
    public function saveNewPost(Request $request)
    {
        $user = Auth::user();

        // $thread = Thread::find($request->thread_id);
        $id = $request->thread_id;
        $thread = DB::select(DB::raw(
            "SELECT *
            FROM threads
            WHERE id = :id"
        ), [$id]);
        $thread = new Thread($thread);

        // $posts = $thread->posts;
        $thread_id = $thread->id;
        $posts = DB::select(DB::raw(
            "SELECT *
            FROM posts
            WHERE thread_id = :thread_id"
        ), [$thread_id]);

        $request->validate([
            'content' => ['required', 'max:2000'],
            'thread_id' => ['required']
        ]);

        // Post::create([
        //     'content' => $request->content,
        //     'thread_id' => $request->thread_id,
        //     'user_id' => $user->id
        // ]);
        DB::insert(
            "insert into posts
            (content, thread_id, user_id)
            values (?, ?, ?)",
            [$request->content, $request->thread_id, $user->id]
        );

        flash('Post successfully added!')->success();

        return redirect()->back();
    }

    /**
     * Show the edit post form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showEditPostForm(Post $post)
    {
        $user = Auth::user();

        if (!$user->createdPost($post)) {
            flash('Cannot Edit Post')->error();

            return redirect()->back();
        }

        return view('edit_post', compact('user', 'post'));
    }

    /**
     * Save a newly created post.
     *
     * @return Redirect
     */
    public function updatePost(Request $request)
    {
        $user = Auth::user();
        $post = Post::find($request->post_id);

        if (!$user->createdPost($post)) {
            flash('Cannot Update Post')->error();

            return redirect()->back();
        }

        $request->validate(Post::RulesForCreating());

        $post->content = $request->content;
        $post->save();

        flash('Post Successfully Updated!')->success();

        $thread = $post->thread;
        $posts = $thread->posts;
        return redirect()->route('thread', compact('user', 'thread', 'posts'));
    }

    /**
     * Delete a post.
     *
     * @return Redirect - route back with flash message.
     */
    public function deletePost(Post $post)
    {
        $user = Auth::user();

        if ($user->can('delete-any-post') || ($user->createdPost($post))) {
            $post->delete();

            flash('Post Successfully Deleted!')->success();
        } else {
            flash('Post Could Not Be Deleted!')->error();
        }

        return redirect()->back();
    }
}
