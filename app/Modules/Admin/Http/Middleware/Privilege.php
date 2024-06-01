<?php

namespace Admin\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Privilege
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param null $guard
     * @return mixed
     */
    public function handle($request, Closure $next = null, $guard = null/*, ...$privileges*/)
    {
        if (Auth::guard($guard)->check() /*&& in_array(Auth::guard('admin')->user()->role_id, $privileges)*/) {
            return $next($request);
        } else {
            return redirect()->route('admins.login');
        }
    }
}
