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
        'user_id',
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
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
    * Get the posts for the thread
    *
    * @return Post[]
    */
    public function posts()
    {
        return $this->hasMany('App\Post');
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
