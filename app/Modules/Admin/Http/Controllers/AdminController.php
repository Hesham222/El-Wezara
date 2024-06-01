<?php

namespace Admin\Http\Controllers;
use Admin\Models\Role;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Admin\Actions\Admin\{
    StoreAction,
    UpdateAction,
    TrashAction,
    RestPasswordAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
};
use Admin\Http\Requests\Admin\{
    StoreRequest,
    UpdateRequest,
    RemoveRequest,
    ResetPasswordRequest,
    FilterDateRequest
};
use Admin\Exports\Admin\{
    ExportData,
};
use Admin\Models\{
    Admin
};

class AdminController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
            checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')
        )
            return view('Admin::admins.index');
        else
            return abort(401);
    }

    public function create()
    {
        if (checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
        ){
            $roles = Role::with('permissions')->has('permissions')->get();
            return view('Admin::admins.create',compact('roles'));
        }else
            return abort(401);

    }

    public function store(StoreRequest $request, StoreAction $storeAction)
    {
        if (checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
        ){
            DB::beginTransaction();
            try {
                $storeAction->execute($request);
                DB::commit();
                return redirect()->route('admins.admin.create')->with('success','Data has been saved successfully.');
            } catch (\Exception $exception) {
                DB::rollback();
                return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
            }
        }else
            return abort(401);
    }

    public function edit($id)
    {
        if (checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')
        ){
            $record = Admin::findOrFail($id);
            $roles = Role::with('permissions')->has('permissions')->get();
            return view('Admin::admins.edit', compact('record','roles'));
        }else
            return abort(401);

    }

    public function update(UpdateRequest $request, UpdateAction $updateAction, $id)
    {
        if (checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')
        ){
            DB::beginTransaction();
            try {
                $updateAction->execute($request, $id);
                DB::commit();
                return redirect()->route('admins.admin.index')->with('success','Data has been saved successfully.');
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
        $result = view('Admin::admins.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
                return Excel::download(new ExportData($records), 'admins_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occured, Please try again later.');
        }
    }

    public function resetPassword(ResetPasswordRequest $request, RestPasswordAction $restPassAction)
    {
        if (checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')
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
        if (checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')
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
        if (checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')
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
        if (checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')
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
        return Admin::onlyTrashed()->count();
    }
}
