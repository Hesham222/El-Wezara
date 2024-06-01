<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Organization\Http\Middleware\OrganizationAdmin;

class VerifyApiToken extends Middleware
{
    public function handle(Request $request, Closure $next)
    {

        if ($this->verify($request)) {
            return $next($request);
        }

        throw new TokenMismatchException;
    }


    public function verify($request): bool //optional return types
    {
       // return dd($request->header('token'));
        $admin = \Organization\Models\OrganizationAdmin::select('id')->where('api_token',$request->bearerToken())->first();
       if ($admin){
           return 1;
       }else{return 0;}
    }


}
