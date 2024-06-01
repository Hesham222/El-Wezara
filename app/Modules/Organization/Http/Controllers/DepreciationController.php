<?php

namespace Organization\Http\Controllers;

use Organization\Models\AssetCategory;

class DepreciationController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialDepreciation-View')
        ){
            $assetCategories = AssetCategory::all();
            return view('Organization::depreciations.index',compact('assetCategories'));
        }else
            return abort(401);
    }
}
