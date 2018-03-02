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
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get Thread the post belongs to.
     *
     * @return Thread
     */
    public function thread()
    {
        return $this->belongsTo('App\Thread');
    }
}
