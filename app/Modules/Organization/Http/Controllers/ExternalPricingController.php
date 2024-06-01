<?php

namespace Organization\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Models\CustomerType;
use Organization\Models\External;
use Organization\Models\SportActivityAreas;
use Organization\Actions\ExternalPricing\{
    StoreAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
    ScheduleStoreAction,
    PricingStoreAction,
    ScheduleUpdateAction,
    PricingUpdateAction,
};
use Organization\Http\Requests\ExternalPricing\{
    StoreRequest,
    UpdateRequest,
    RemoveRequest,
    FilterDateRequest
};
use Organization\Exports\ExternalPricing\{
    ExportData,
};
use Organization\Models\{
    ExternalPricing
};

class ExternalPricingController extends JsonResponse
{
    public function index()
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'ReservationPricing-View')
        ){
            $areas          = SportActivityAreas::has('ExternalPricing')->select(['id','name'])->get();
            return view('Organization::externalPricing.index',compact('areas'));
        }else
            return abort(401);
    }

    public function create()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'ReservationPricing-Add')
        ){
            $subscriberTypes    = CustomerType::select(['id','name'])->get();
            $activityAreas      = SportActivityAreas::select(['id','name'])->get();

            return view('Organization::externalPricing.create',compact('activityAreas','subscriberTypes'));
        }else
            return abort(401);

    }


    public function getPricingRow()
    {
        $subscriberTypes    = CustomerType::select(['id','name'])->get();

        $results = view('Organization::externalPricing.components.pricing.row',compact('subscriberTypes'),
            [

            ])->render();

        return $this->response(200, 'Pricing Row', 200, [], 0, ['responseHTML' => $results]);
    }

    public function store(Request $request, StoreAction $storeAction ,PricingStoreAction $pricingStoreAction)
    {

        DB::beginTransaction();
        try {
            if (ExternalPricing::where('activity_area_id',$request->input('activity_area_id'))->exists()){
                return redirect()->route('organizations.externalPrice.create')->with('error','خطأ, هذه المنطقه تمتلك سعر بالساعه.')->withInput();
            }else{
                $record =   $storeAction->execute($request);
                $pricing =  $pricingStoreAction->execute($request,$record);
            }

            DB::commit();
            return redirect()->route('organizations.externalPrice.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function edit($id)
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'ReservationPricing-Edit')
        ){
            $record             = ExternalPricing::find($id);
            $activityAreas      = SportActivityAreas::select(['id','name'])->get();
            $subscriberTypes    = CustomerType::select(['id','name'])->get();
            return view('Organization::externalPricing.edit', compact('record','activityAreas','subscriberTypes'));
        }else
            return abort(401);
    }

    public function update(Request $request, UpdateAction $updateAction ,PricingUpdateAction $pricingUpdateAction, $id)
    {
        DB::beginTransaction();
        try {
            $record = $updateAction->execute($request, $id);

            $pricing =  $pricingUpdateAction->execute($request,$record);
            DB::commit();
            return redirect()->route('organizations.externalPrice.index')->with('success','Data has been saved successfully.');
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
                'area'       => $request->input('area'),

            ]);
        $result = view('Organization::externalPricing.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'organization_externalPricing_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'ReservationPricing-Delete')
        ){
            DB::beginTransaction();
            try {
                $record =  $trashAction->execute($request);
                if(!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);
                DB::commit();
                return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'externalPricing', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'externalPricing', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'externalPricing', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    private function countTrashes()
    {
        return ExternalPricing::onlyTrashed()->count();
    }
}
