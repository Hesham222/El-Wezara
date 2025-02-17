<?php

namespace Organization\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticatedOrganizationUser
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
        if (Auth::guard($guard)->check())
            return $next($request);
        return redirect()->route('organizations.login');
    }
}
