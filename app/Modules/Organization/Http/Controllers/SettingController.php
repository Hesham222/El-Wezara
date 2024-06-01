<?php

namespace Organization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


use Organization\Models\{Setting};

class SettingController extends JsonResponse
{
    public function index()
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')
        ){
            $setting = Setting::first();
            if ($setting){
                return view('Organization::settings.index',compact('setting'));
            }else{
                $setting = new Setting();
                return view('Organization::settings.index',compact('setting'));

            }
        }

        else
            return abort(401);
    }



    public function store(Request $request)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
        ) {
            DB::beginTransaction();
            try {
                $setting = Setting::first();
                if ($setting){
                    $setting->dynamic_percentage = $request->per_value;
                    $setting->save();
                }else{
                    $setting = new Setting();
                    $setting->dynamic_percentage = $request->per_value;
                    $setting->save();
                }

                DB::commit();
                return redirect()->back()->with('success', 'Data has been saved successfully.');
            } catch (\Exception $exception) {
                DB::rollback();
                return redirect()->back()->with('error', 'Failed, Please try again later.')->withInput();
            }
        }else
            return abort(401);
    }


}
