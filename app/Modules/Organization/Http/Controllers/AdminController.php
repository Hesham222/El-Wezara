<?php

namespace Organization\Http\Controllers;
use Organization\Models\Role;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\Admin\{
    StoreAction,
    UpdateAction,
    TrashAction,
    RestPasswordAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
};
use Organization\Http\Requests\Admin\{
    StoreRequest,
    UpdateRequest,
    RemoveRequest,
    ResetPasswordRequest,
    FilterDateRequest
};
use Organization\Exports\Admin\{
    ExportData,
};
use Organization\Models\{
    OrganizationAdmin
};

class AdminController extends JsonResponse
{
    public function index()
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')
        )
            return view('Organization::admins.index');
        else
            return abort(401);
    }

    public function create()
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
        ){
            $roles = Role::with('permissions')->has('permissions')->get();
            return view('Organization::admins.create',compact('roles'));
        }else
            return abort(401);

    }

    public function store(StoreRequest $request, StoreAction $storeAction)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
        ){
            DB::beginTransaction();
            try {
                $storeAction->execute($request);
                DB::commit();
                return redirect()->route('organizations.admin.create')->with('success','Data has been saved successfully.');
            } catch (\Exception $exception) {
                DB::rollback();
                return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
            }
        }else
            return abort(401);
    }

    public function edit($id)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')
        ){
            $record = OrganizationAdmin::findOrFail($id);
            $roles = Role::with('permissions')->has('permissions')->get();
            return view('Organization::admins.edit', compact('record','roles'));
        }else
            return abort(401);

    }

    public function update(UpdateRequest $request, UpdateAction $updateAction, $id)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')
        ){
            DB::beginTransaction();
            try {
                $updateAction->execute($request, $id);
                DB::commit();
                return redirect()->route('organizations.admin.index')->with('success','Data has been saved successfully.');
            } catch (\Exception $exception) {
                DB::rollback();
                return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
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
        $result = view('Organization::admins.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
                return Excel::download(new ExportData($records), 'organization_admins_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function resetPassword(ResetPasswordRequest $request, RestPasswordAction $restPassAction)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')
        ){
            DB::beginTransaction();
            try {
                $restPassAction->execute($request);
                DB::commit();
                return $this->response(200, 'Password was reset successfully.', 200);
            } catch (\Exception $ex) {
                DB::rollBack();
                return $this->response(500, 'Failed, Please try again later.', 200);
            }
        }else
            return abort(401);

    }

    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')
        ){
            DB::beginTransaction();
            try {
                $record =  $trashAction->execute($request);
                if(!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);
                DB::commit();
                return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'admins', 'trashesCount' => $this->countTrashes()]);
            } catch (\Exception $ex) {
                DB::rollBack();
                return $this->response(500, 'Failed, Please try again later.', 200);
            }
        }else
            return abort(401);
    }

    public function destroy(RemoveRequest $request, DestroyAction $destroyAction, $id)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')
        ){
            DB::beginTransaction();
            try {
                if ($id === 1)
                    return $this->response(500, 'Failed, You can not delete this record.', 200);
                $record =  $destroyAction->execute($request, $id);
                if(!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);
                DB::commit();
                return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'admins', 'trashesCount' => $this->countTrashes()]);
            } catch (\Exception $ex) {
                DB::rollBack();
                return $this->response(500, 'Failed, Please try again later.', 200);
            }
        }else
            return abort(401);

    }

    public function restore(RemoveRequest $request, RestoreAction $restoreAction)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')
        ){
            DB::beginTransaction();
            try {
                $record =  $restoreAction->execute($request);
                DB::commit();
                return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'admins', 'trashesCount' => $this->countTrashes()]);
            } catch (\Exception $ex) {
                DB::rollBack();
                return $this->response(500, 'Failed, Please try again later.', 200);
            }
        }else
            return abort(401);

    }

    private function countTrashes()
    {
        return OrganizationAdmin::onlyTrashed()->count();
    }
}
