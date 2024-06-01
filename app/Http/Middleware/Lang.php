<?php

namespace App\Http\Middleware;


use Closure;

class Lang
{
    public function handle($request, Closure $next)
    {
        if (session()->get('lang') == 'en')
            app()->setLocale('en');
        else
            app()->setLocale('ar');

        return $next($request);
    }
}
