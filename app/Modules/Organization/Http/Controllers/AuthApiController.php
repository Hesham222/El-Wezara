<?php

namespace Organization\Http\Controllers;

use Admin\Models\Organization;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Organization\Http\Requests\AuthApi\LoginRequest;
use Organization\Http\Resources\OrganizationAdminResource;

class AuthApiController extends BaseResponse
{




    public function adminLogin(LoginRequest $request)
    {


        $organization = 0;
        $organization_ids = Organization::pluck('id');

        foreach ($organization_ids as $key => $organization_id)
        {

            $db = DBConnection($organization_id);

            $all_admins = $db->table('organization_admins')->pluck('name');



            foreach ($all_admins as $admin)
            {
                if ($admin == request('name'))
                {

                    $organization = $organization_id;
                    break;
                }
            }

            if ($organization != 0){
                break;
            }


        }

        if ($organization != 0)
        {
            DBConnection($organization);

        }






            if (Auth::guard('organization_admin')->attempt([
                'name' => $request->input('name'),
                'password' => $request->input('password'),
            ])) {
                //session::put('organization_id',$organization);
                $admin = Auth::guard('organization_admin')->user();
                if (!$admin->api_token) {
                    $admin->api_token = Str::random(80);
                    $admin->save();
                }

                return $this->response(200, $admin->api_token, 200, [], 0, [
                     'organization_admin' => new OrganizationAdminResource($admin),
                ]);
            }
            return $this->response(101, 'Validation Error', 200, ['supplier not found']);
        }



    public function logout()
    {
       // Session::forget('organization_id');
        $user = auth('organization_admin_api')->user();
        $user->api_token = null;
        $user->save();
        config(['database.connections.elwezara' => [
            'driver'     => 'mysql',
            'host'       => config('database.connections.mysql.host'),
            'database'   => 'elwezara',
            'username'   => config('database.connections.mysql.username'),
            'password'   => config('database.connections.mysql.password'),
        ]]);
        Config::set('database.default', 'elwezara');
        return $this->response(200, 'You are logged out successfully', 200);
    }
}
