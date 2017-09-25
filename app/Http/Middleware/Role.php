<?php

namespace App\Http\Middleware;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //if not logged in, deny
        if (Auth::guest()) {
            abort(403);
        }

        //check permission
        dump($role);
        if (!$request->user()->hasRole($role)) {
           abort(403);
        }

        return $next($request);
    }
}
