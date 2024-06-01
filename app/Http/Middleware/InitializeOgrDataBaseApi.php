<?php

namespace App\Http\Middleware;

use Admin\Models\Organization;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class InitializeOgrDataBaseApi
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $organization_id =  $request->header('organizationId');


        $organization = Organization::where('id', $organization_id)->first();
        // return dd($organization_id,$organization);
        if ($organization) {
            Config::set('database.connections.organization', [
                'driver' => 'mysql',
                'host' => config('database.connections.mysql.host'),
                'database' => 'organization_' . $organization_id,
                'username' => config('database.connections.mysql.username'),
                'password' => config('database.connections.mysql.password'),
                'charset' => 'utf8',
                'collation' => 'utf8_general_ci',
            ]);
            Config::set('database.default', 'organization');
            return $next($request);
        }
        return response('Unauthenticated', 401);
    }
}
