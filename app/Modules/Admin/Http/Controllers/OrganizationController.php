<?php

namespace Admin\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Admin\Actions\Organization\{
    StoreAction,
    AssignServicesAction,
    AssignDatabaseAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
};
use Admin\Http\Requests\Organization\{
    StoreRequest,
    UpdateRequest,
    RemoveRequest,
    FilterDateRequest
};
use Admin\Exports\Organization\{
    ExportData,
};
use Admin\Models\{
    Organization,
    Service
};

class OrganizationController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Module')||
            checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-View')||
            checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Edit')||
            checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Delete')
        )
            return view('Admin::organizations.index');
        else
            return abort(401);
    }

    public function create()
    {
        if (checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Module')||
            checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Add')
        ){
            $services = Service::select(['id', 'name'])->get();
            return view('Admin::organizations.create',compact('services'));
        }else
            return abort(401);

    }

    public function store(StoreRequest $request, StoreAction $storeAction, AssignServicesAction $assignServicesAction, AssignDatabaseAction $assignDatabaseAction )
    {
        if (checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Module')||
            checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Add')
        ) {
          //  DB::beginTransaction();
            try {
                $record = $storeAction->execute($request);
//                if ($record['flag'] == 0)
//                    return back()->with('error','this name is used try new one !');

                $assignServicesAction->execute($request, $record);
                $assignDatabaseAction->execute($request, $record);

            //    DB::commit();
                return redirect()->route('admins.organization.create')->with('success', 'Data has been saved successfully.');
            } catch (\Exception $exception) {
              //  DB::rollback();
                return redirect()->back()->with('error', 'this name is used try new one !')->withInput();
            }
        }
        return abort(401);
    }

    public function edit($id)
    {
        if (checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Module')||
            checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Edit')
        ){
            $record = Organization::findOrFail($id);
            $services = Service::select(['id', 'name'])->get();
            return view('Admin::organizations.edit', compact('record','services'));
        }else
            return abort(401);
    }

    public function update(UpdateRequest $request, UpdateAction $updateAction, AssignServicesAction $assignServicesAction , $id)
    {
        if (checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Module')||
            checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Edit')
        ){
            DB::beginTransaction();
            try {
                $record = $updateAction->execute($request, $id);
                $assignServicesAction->execute($request, $record);
                DB::commit();
                return redirect()->route('admins.organization.index')->with('success','Data has been saved successfully.');
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
        $result = view('Admin::organizations.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
                return Excel::download(new ExportData($records), 'organizations_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occured, Please try again later.');
        }
    }


    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {
        if (checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Module')||
            checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Delete')
        ){
            DB::beginTransaction();
            try {
                $record =  $trashAction->execute($request);
                if(!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);
                DB::commit();
                return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'organizations', 'trashesCount' => $this->countTrashes()]);
            } catch (\Exception $ex) {
                DB::rollBack();
                return $this->response(500, 'Failed, Please try again later.', 200);
            }
        }else
            return abort(401);

    }

    public function destroy(RemoveRequest $request, DestroyAction $destroyAction, $id)
    {
        if (checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Module')||
            checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Delete')
        ){
            DB::beginTransaction();
            try {
                $record =  $destroyAction->execute($request, $id);
                if(!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);
                DB::commit();
                return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'organizations', 'trashesCount' => $this->countTrashes()]);
            } catch (\Exception $ex) {
                DB::rollBack();
                return $this->response(500, 'Failed, Please try again later.', 200);
            }
        }else
            return abort(401);

    }

    public function restore(RemoveRequest $request, RestoreAction $restoreAction)
    {
        if (checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Module')||
            checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Delete')
        ){
            DB::beginTransaction();
            try {
                $record =  $restoreAction->execute($request);
                DB::commit();
                return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'organizations', 'trashesCount' => $this->countTrashes()]);
            } catch (\Exception $ex) {
                DB::rollBack();
                return $this->response(500, 'Failed, Please try again later.', 200);
            }
        }else
            return abort(401);
    }

    public function login($organizationId)
    {
        return  redirect('organizations/'.$organizationId);
    }

    private function countTrashes()
    {
        return Organization::onlyTrashed()->count();
    }
}
