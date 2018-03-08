<?php

namespace App\Http\Middleware;

use Closure;

class SecureHeaderInfo
{
    /**
     * Remove some header info that attackers could
     * use to attack system
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $response->header('Server', 'feels bad');

        return $response;
    }
}
