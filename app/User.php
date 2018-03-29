<?php

namespace App;

use App\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Silber\Bouncer\BouncerFacade as Bouncer;
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
        'name', 'email', 'password', 'banned', '2fa_secret'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', '2fa_secret'
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
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * Get the threads created by the user.
     *
     * @return Thread[]
     */
    public function threads()
    {
        return $this->hasMany('App\Thread');
    }

    /**
     * Get if the user created the post or not.
     *
     * @return Boolean
     */
    public function createdPost(Post $post)
    {
        if ($post->user_id == $this->id) {
            return true;
        }

        return false;
    }

    /**
     * Get if the user created the thread and if it can be deleted.
     *
     * @return Boolean
     */
    public function createdThread(Thread $thread)
    {
        if ($thread->user_id == $this->id && $thread->posts->count() == 0) {
            return true;
        }

        return false;
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

    /**
     * Get the users role in a readable form.
     * @return [String] role
     */
    public function role()
    {
        if (Bouncer::is($this)->a('admin')) {
            return 'Administrator';
        } elseif (Bouncer::is($this)->a('moderator')) {
            return 'Moderator';
        } else {
            return 'Standard User';
        }
    }

    /**
     * Enrypt the user's 2fa secret.
     *
     * @param  string  $value
     * @return string
     */
    public function set2faSecretAttribute($secret)
    {
        $secret = $secret !== null ? encrypt($secret) : null;
        $this->attributes['2fa_secret'] = $secret;
    }

    /**
     * Decrypt the user's 2fa secret.
     *
     * @param  string  $value
     * @return string
     */
    public function get2faSecretAttribute($secret)
    {
        return $secret === null ? $secret : decrypt($secret);
    }
}
