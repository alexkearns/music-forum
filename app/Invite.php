<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'token',
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * Rules for validating user creates/stores.
     *
     * @return array
     */
    public static function rulesForCreating()
    {
        return [
            'email'     => ['required', 'email'],
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
}
