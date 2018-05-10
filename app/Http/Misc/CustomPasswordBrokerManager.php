<?php

namespace App\Http\Misc;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Illuminate\Contracts\Auth\PasswordBrokerFactory as FactoryContract;

/**
 * @mixin \Illuminate\Contracts\Auth\PasswordBroker
 */
class CustomPasswordBrokerManager extends \Illuminate\Auth\Passwords\PasswordBrokerManager
{
    /**
     * Resolve the given broker.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     *
     * @throws \InvalidArgumentException
     */
    protected function resolve($name)
    {
        $config = $this->getConfig($name);

        if (is_null($config)) {
            throw new InvalidArgumentException("Password resetter [{$name}] is not defined.");
        }

        // The password broker uses a token repository to validate tokens and send user
        // password e-mails, as well as validating that password reset process as an
        // aggregate service of sorts providing a convenient interface for resets.
        return new CustomPasswordBroker(
            $this->createTokenRepository($config),
            $this->app['auth']->createUserProvider($config['provider'] ?? null)
        );
    }
}
