<?php

namespace Organization\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\VendorType\{
    StoreAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
    DayPricingStoreAction,
    PricingStoreAction,
    DayPricingUpdateAction,
    PricingUpdateAction,
    InformationStoreAction,
    InformationUpdateAction,
};
use Organization\Http\Requests\VendorType\{
    StoreRequest,
    UpdateRequest,
    RemoveRequest,
    FilterDateRequest
};
use Organization\Exports\CustomerType\{
    ExportData,
};
use Organization\Models\{CustomerType, VendorType};

class VendorTypeController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'VendorType-View')
        ){
            return view('Organization::vendorTypes.index');

        }else
            return abort(401);
    }

    public function create()
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'VendorType-Add')
        ){
            return view('Organization::vendorTypes.create');

        }else
            return abort(401);
    }

    public function getInformationRow()
    {


        $results = view('Organization::vendorTypes.components.information.row',
            [

            ])->render();

        return $this->response(200, 'Information Row', 200, [], 0, ['responseHTML' => $results]);
    }



    public function store(Request $request, StoreAction $storeAction,InformationStoreAction $informationStoreAction)
    {
        DB::beginTransaction();
        try {
            $record             =   $storeAction->execute($request);
            $information        =   $informationStoreAction->execute($request,$record);

            DB::commit();
            return redirect()->route('organizations.vendorType.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function edit($id)
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'VendorType-Edit')
        ){
            $record        = VendorType::find($id);

            return view('Organization::vendorTypes.edit',compact('record'));
        }else
            return abort(401);
    }

    public function update(Request $request, UpdateAction $updateAction,InformationUpdateAction $informationUpdateAction, $id)
    {
        DB::beginTransaction();
        try {
            $record             =   $updateAction->execute($request, $id);
            $information        =   $informationUpdateAction->execute($request,$record);

            DB::commit();
            return redirect()->route('organizations.vendorType.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
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
        $result = view('Organization::vendorTypes.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'organization_vendor_Types_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'VendorType-Delete')
        ){
            DB::beginTransaction();
            try {
                $record =  $trashAction->execute($request);
                if(!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);
                DB::commit();
                return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'vendor-type', 'trashesCount' => $this->countTrashes()]);
            } catch (\Exception $ex) {
                DB::rollBack();
                return $this->response(500, 'Failed, Please try again later.', 200);
            }
        }else
            return abort(401);

    }

    public function destroy(Request $request, DestroyAction $destroyAction, $id)
    {

        DB::beginTransaction();
        try {
            if ($id === 1)
                return $this->response(500, 'Failed, You can not delete this record.', 200);

            $record =  $destroyAction->execute($request, $id);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);
            DB::commit();
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'vendor-type', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    public function restore(RemoveRequest $request, RestoreAction $restoreAction)
    {
        DB::beginTransaction();
        try {
            $record =  $restoreAction->execute($request);
            DB::commit();
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'vendor-type', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    private function countTrashes()
    {
        return VendorType::onlyTrashed()->count();
    }
}
