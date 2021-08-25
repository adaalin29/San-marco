<?php

namespace App\Http\Middleware;

use Closure;

class ChangeApiGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        config(['auth.defaults.guard' => $guard]);
        config(['auth.guards.api' => config('auth.guards.'.$guard)]);
        return $next($request);
    }
}
