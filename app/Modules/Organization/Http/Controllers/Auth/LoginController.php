<?php

namespace Organization\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Admin\Models\Organization;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    //return view of login page (Admin portal)
    public function login()
    {
        //dd(Session::all());
       // Session::forget('organization_id');
        if (Session::has('organization_id'))
            return back();
        return view('Organization::_auth.login');
    }

    public function CheckLogin()
    {

        $organization = 0;
        $organization_ids = Organization::pluck('id');
        $count = [];
        $flag= false;
        foreach ($organization_ids as $key => $organization_id)
        {

            $db = DBConnection($organization_id);
            if($key==1){
               // dd(\DB::connection('organization'), $organization_id, config('database.connections.organization') );
            }
            $all_admins = $db->table('organization_admins')->pluck('name');



            foreach ($all_admins as $admin)
            {
                array_push($count,$admin);
                if ($admin == request('email'))
                {
                   $flag =true;
                    $organization = $organization_id;
                    break;
                }
            }

            if ($organization != 0){
                break;
            }


        }

//dd($organization_ids, $flag, $key, $db);
       // $organization = 31;
        if ($organization != 0)
        {
//
            DBConnection($organization);
           // dd($count,$organization);



        }
       // dd($organization);
       // $organization = 31;
        //$organization = $this->getOrganization(request()->segment(2));

        $remember = request('rememberme') == 1 ? true : false;
      // $res= DBConnection($organization);

       // dd($res,\DB::connection()->getDatabaseName());

        if (auth()->guard('organization_admin')->attempt(['name' => request('email'), 'password' => request('password')], $remember)) {
            session::put('organization_id',$organization);
            return redirect()->route('organizations.home');
        } else
            session()->flash('error', "email and password doesn't match our records");
            return redirect()->route('organizations.login');
    }

    public function logout()
    {
        Session::forget('organization_id');

        auth()->guard('organization_admin')->logout();
        config(['database.connections.elwezara' => [
            'driver'     => 'mysql',
            'host'       => config('database.connections.mysql.host'),
            'database'   => 'elwezara',
            'username'   => config('database.connections.mysql.username'),
            'password'   => config('database.connections.mysql.password'),
        ]]);
        Config::set('database.default', 'elwezara');
        return redirect()->route('organizations.login');
    }

    private function getOrganization($id)
    {
        return Organization::find($id);
    }
}
