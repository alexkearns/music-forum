<?php

namespace App;

use App\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use App\Post;
use App\Thread;

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
        'name', 'email', 'password', 'banned'
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
            'password'  => ['required', 'between:5,32', 'pwned:150'],
            'name'      => ['required', 'between:2,32'],
        ];
    }

    public static function messages()
    {
        return [
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be valid.',
            'password.required'  => 'The password field is required.',
            'password.between' => 'The password must be between 5 and 32 characters.',
            'password.pwned' => 'This password has been leaked too many times',
            'name.required' => 'The name field is required',
            'name.between' => 'The name must be between 2 and 32 characters.',
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

    /**
     * Ban the user
     */
    public function ban()
    {
        $this->banned = true;
        $this->save();
    }

    /**
     * Reinstate the user
     */
    public function reinstate()
    {
        $this->banned = false;
        $this->save();
    }
}
