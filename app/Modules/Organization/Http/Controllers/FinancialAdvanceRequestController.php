<?php

namespace Organization\Http\Controllers;
use Admin\Models\Admin;
use Illuminate\Support\Facades\DB;
use Organization\Actions\FinancialAdvanceRequest\{ApproveAction,
    FilterDepartmwntAction,
    FilterEmpAction,
    RejectAction,
    StoreAction,
    FilterAction};
use Organization\Http\Requests\FinancialAdvanceRequest\{
    StoreRequest,
    FilterDateRequest
};
use Organization\Exports\FinancialAdvanceRequest\{
    ExportData,
};
use Organization\Models\{Employee,FinancialAdvanceRequest, OrganizationAdmin};

class FinancialAdvanceRequestController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialRequest-View')
        ){
            return view('Organization::financialAdvanceRequests.index');

        }else
            return abort(401);
    }


    public function indexDepartment($id)
    {
        if (auth('organization_admin')->user()->employee->isHeadOfDepartment($id))
            return view('Organization::financialAdvanceRequests.indexDepartment');
        else
            return abort(401);
    }

    public function create($empId = null)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')||
            checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialRequest-Add')
        ){
            return view('Organization::financialAdvanceRequests.create',compact('empId'));
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
                return redirect()->route('organizations.financialAdvanceRequest.index')->with('success', 'Data has been saved successfully.');

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
        $result = view('Organization::financialAdvanceRequests.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }


    public function dataDepartment(FilterDateRequest $request, FilterDepartmwntAction $filterAction)
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
        $result = view('Organization::financialAdvanceRequests.components.table_body_dapartment',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }



    public function approve($id,ApproveAction $approveAction)
    {

        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
        ) {

            $financialAdvanceRequest = FinancialAdvanceRequest::FindOrFail($id);

            if (! auth('organization_admin')->user()->employee->isHeadOfDepartment($financialAdvanceRequest->employee->department_id) || $financialAdvanceRequest->status !='Pending' ){
                return abort(401);
            }



            DB::beginTransaction();
            try {

                $approveAction->execute($id);
                DB::commit();
                return redirect()->route('organizations.financialAdvanceRequest.indexDepartment',$financialAdvanceRequest->employee->department_id)->with('success', 'Data has been saved successfully.');

            } catch (\Exception $exception) {
                DB::rollback();
                return redirect()->back()->with('error', 'Failed, Please try again later.')->withInput();
            }
        }else
            return abort(401);
    }


    public function reject($id,RejectAction $rejectAction)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
        ) {

            $financialAdvanceRequest = FinancialAdvanceRequest::FindOrFail($id);

            if (! auth('organization_admin')->user()->employee->isHeadOfDepartment($financialAdvanceRequest->employee->department_id)  || $financialAdvanceRequest->status !='Pending' ){
                return abort(401);
            }


            DB::beginTransaction();
            try {

                $rejectAction->execute($id);
                DB::commit();
                return redirect()->route('organizations.financialAdvanceRequest.indexDepartment',$financialAdvanceRequest->employee->department_id)->with('success', 'Data has been saved successfully.');

            } catch (\Exception $exception) {
                DB::rollback();
                return redirect()->back()->with('error', 'Failed, Please try again later.')->withInput();
            }
        }else
            return abort(401);
    }


    public function empVacation($id)
    {
        $emp = Employee::FindOrFail($id);
        return view('Organization::financialAdvanceRequests.financialEmpRequests',compact('emp'));
    }



    public function empVacationData(FilterDateRequest $request, FilterEmpAction $filterAction)
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
        $result = view('Organization::financialAdvanceRequests.components.table_body_emp',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }


}
