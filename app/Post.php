<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Thread;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'thread_id', // The thread that the post belongs to.
        'user_id' // The user who created the post on the Thread.
    ];

    /**
     * Rules for validating a Post creation.
     *
     * @return array
     */
    public static function rulesForCreating()
    {
        return [
            'content' => ['required'],
            'thread_id' => ['sometimes', 'required'],
            'user_id' => ['sometimes', 'required'],
        ];
    }

    /**
     * Get User who created the post.
     *
     * @return User
     */
    public function getUser()
    {
        return User::find($this->user_id);
    }

    /**
     * Get Thread the post belongs to.
     *
     * @return User
     */
    public function getThread()
    {
        return Thread::find($this->thread_id);
    }
}
