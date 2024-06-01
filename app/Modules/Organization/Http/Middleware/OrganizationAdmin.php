<?php

namespace Organization\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OrganizationAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param null $guard
     * @return mixed
     */
    public function handle($request, Closure $next = null, $guard = null)
    {
        if (Auth::guard($guard)->check() /*&& Auth::guard($guard)->user()->isSuper === 1*/)
            return $next($request);
        else 
            return abort(403);
    }
}
