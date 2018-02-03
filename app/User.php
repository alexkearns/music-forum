<?php

namespace App;

use App\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Post;
use App\Thread;
use Silber\Bouncer\Database\HasRolesAndAbilities;

class User extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Rules for validating user creates/stores.
     *
     * @return array
     */
    public static function rulesForCreating()
    {
        return [
            'email'     => ['required', 'email', 'unique:users,email'],
            'password'  => ['sometimes', 'required', 'between:5,32'],
            'name'      => ['required', 'between:2,32'],
        ];
    }

    /**
     * Get the posts created by the user.
     *
     * @return Post[]
     */
    public function getPosts()
    {
        return Post::where('user_id', $this->id)->get();
    }

    /**
     * Get the threads created by the user.
     *
     * @return Thread[]
     */
    public function getThreads()
    {
        return Thread::where('user_id', $this->id)->get();
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
}
