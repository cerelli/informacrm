<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        //if not logged in, deny
        if (Auth::guest()) {
            abort(403);
        }

        //check permission
        // dd($permission);
        if (!$request->user()->can($permission)) {
           abort(403);
        }

        return $next($request);
    }
}
