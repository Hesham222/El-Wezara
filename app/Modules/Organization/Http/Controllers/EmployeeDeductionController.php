<?php

namespace Organization\Http\Controllers;
use Admin\Models\Admin;
use Illuminate\Support\Facades\DB;
use Organization\Actions\EmployeeDeduction\{ApproveAction,
    FilterDepartmwntAction,
    FilterEmpAction,
    RejectAction,
    StoreAction,
    FilterAction};
use Organization\Http\Requests\EmployeeDeduction\{
    StoreRequest,
    FilterDateRequest
};
use Organization\Exports\EmployeeDeduction\{
    ExportData,
};
use Organization\Models\{Employee,EmployeeDeduction, OrganizationAdmin};

class EmployeeDeductionController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EmployeeDeduction-View')
        ){
            return view('Organization::employeeDeductions.index');

        }else
            return abort(401);
    }


    public function create($empId = null)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')||
            checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EmployeeDeduction-Add')
        ){
            return view('Organization::employeeDeductions.create',compact('empId'));
        }

        else
            return abort(401);
    }

    public function store(StoreRequest $request, StoreAction $storeAction)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
        ) {
            DB::beginTransaction();
            try {
                $storeAction->execute($request);
                DB::commit();
                return redirect()->route('organizations.employeeDeduction.index')->with('success', 'Data has been saved successfully.');

            } catch (\Exception $exception) {
                DB::rollback();
                return redirect()->back()->with('error', 'Failed, Please try again later.')->withInput();
            }
        }else
            return abort(401);
    }



    public function data(FilterDateRequest $request, FilterAction $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $result = view('Organization::employeeDeductions.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }



    public function empDeduction($id)
    {
        $emp = Employee::FindOrFail($id);
        return view('Organization::employeeDeductions.employeeDeductions',compact('emp'));
    }



    public function empDeductionData(FilterDateRequest $request, FilterEmpAction $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $result = view('Organization::employeeDeductions.components.table_body_emp',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }


}
