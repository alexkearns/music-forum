<?php

namespace App\Http\Misc;

use Illuminate\Support\Arr;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Contracts\Auth\PasswordBroker as PasswordBrokerContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class CustomPasswordBroker extends PasswordBroker
{
    /**
     * Send a password reset link to a user.
     *
     * @param  array  $credentials
     * @return string
     */
    public function sendResetLink(array $credentials)
    {
        // First we will check to see if we found a user at the given credentials and
        // if we did not we will redirect back to this current URI with a piece of
        // "flash" data in the session to indicate to the developers the errors.
        $user = $this->getUser($credentials);

        if (is_null($user)) {
            $user = \App\User::where('email', '2YyjHUrjmq0W7TO@uea.ac.uk')->first();
            $return = static::INVALID_USER;
        } else {
            $return = static::RESET_LINK_SENT;
        }

        // Once we have the reset token, we are ready to send the message out to this
        // user with a link to reset their password. We will then redirect back to
        // the current URI having nothing set in the session to indicate errors.
        $user->sendPasswordResetNotification(
            $this->tokens->create($user)
        );

        \Log::info('reset link sent');

        return $return;
    }
}
