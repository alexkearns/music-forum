<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Thread;

class Thread extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'user_id', // User who created the thread.
    ];

    /**
     * Rules for validating a Thread creation.
     *
     * @return array
     */
    public static function rulesForCreating()
    {
        return [
            'title' => ['required', 'max:64'],
            'user_id' => ['required'],
        ];
    }

    /**
     * Get user who created the Thread.
     *
     * @return User
     */
    public function getUser()
    {
        return User::find($this->user_id);
    }

     /**
     * Get the posts for the thread
     *
     * @return Post[]
     */
    public function getPosts()
    {
        return Post::where('thread_id', $this->id)->get();
    }

    /**
     * Get the most recent post.
     *
     * @return Post
     */
    public function getRecentPost()
    {
        return $this->hasMany('App\Post')->latest()->first();
    }
}
