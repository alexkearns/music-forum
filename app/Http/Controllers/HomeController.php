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
        $threads = Thread::all();

        $this->validate($request, [
            'title' => ['required', 'max:64'],
        ]);

        Thread::create([
            'title' => $request->title,
            'user_id' => $user->id
        ]);

        flash('Thread successfully added!')->success();

        return redirect()->route('home', compact('user', 'threads'));
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
        $posts = $thread->getPosts();

        return view('thread', compact('user', 'thread', 'posts'));
    }

    /**
     * Save a newly created post.
     *
     * @return Redirect
     */
    public function saveNewPost(Request $request)
    {
        $user = Auth::user();
        $thread = Thread::find($request->thread_id);
        $posts = $thread->getPosts();

        $this->validate($request, [
            'content' => ['required'],
            'thread_id' => ['required']
        ]);

        Post::create([
            'content' => $request->content,
            'thread_id' => $request->thread_id,
            'user_id' => $user->id
        ]);

        flash('Post successfully added!')->success();

        return redirect()->route('thread', compact('user', 'thread', 'posts'));
    }

    /**
     * Show the edit post form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showEditPostForm(Post $post)
    {
        $user = Auth::user();

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

        $this->validate($request, Post::RulesForCreating());

        $post->content = $request->content;
        $post->save();

        flash('Post Successfully Updated!')->success();

        $thread = $post->getThread();
        $posts = $thread->getPosts();
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
