<?php

namespace App\Http\Middleware;

use Closure;

class RemoveServerHeader
{
    /**
     * Remove some header info that attackers could use.
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $response->header('Server', 'Feels bad');
        return $response;
    }
}
