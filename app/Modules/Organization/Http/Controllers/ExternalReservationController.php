<?php

namespace Organization\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Models\Customer;
use Organization\Models\External;
use Organization\Models\ExternalPricing;
use Organization\Actions\ExternalReservation\{
    StoreAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
};
use Organization\Http\Requests\ExternalReservation\{
    StoreRequest,
    UpdateRequest,
    RemoveRequest,
    FilterDateRequest
};
use Organization\Exports\ExternalReservation\{
    ExportData,
};
use Organization\Models\{
    ExternalReservation,
    Subscriber
};

class ExternalReservationController extends JsonResponse
{
    public function index()
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'ExternalReservation-View')
        ){
            $subscribers    = Customer::select(['id','name'])->get();

            return view('Organization::externalReservations.index',compact('subscribers'));
        }else
            return abort(401);
    }

    public function create()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'ExternalReservation-Add')
        ){
            $subscribers            = Customer::select(['id','name'])->get();
            $externalPricing        = ExternalPricing::get();
            return view('Organization::externalReservations.create',compact('subscribers','externalPricing'));
        }else
            return abort(401);

    }

    public function store(Request $request, StoreAction $storeAction)
    {
        DB::beginTransaction();
        try {
            if ($storeAction->execute($request)){
                if ($storeAction->isAreaTaken($request)){
                    return redirect()->back()->with('error',' .......... مساحة النشاط الرياضي هذه غير متوفرة في الوقت الذي اخترته .')->withInput();
                }else{
                    $storeAction->execute($request);
                }
            }else{
                return redirect()->back()->with('error',' ..........لا يوجد تسعير لنوع هذا العميل ')->withInput();
            }



            DB::commit();
            return redirect()->route('organizations.externalReservation.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function edit($id)
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'ExternalReservation-Edit')
        ){
            $record                 = ExternalReservation::findOrFail($id);

            $subscribers            = Customer::select(['id','name'])->get();
            $externalPricing        = ExternalPricing::get();

            return view('Organization::externalReservations.edit',compact('record','subscribers','externalPricing'));
        }else
            return abort(401);
    }

    public function update(UpdateRequest $request, UpdateAction $updateAction, $id)
    {
        DB::beginTransaction();
        try {
            if ($updateAction->isAreaTaken($request)){
                return redirect()->back()->with('error',' .......... مساحة النشاط الرياضي هذه غير متوفرة في الوقت الذي اخترته .')->withInput();
            }else{
                $updateAction->execute($request, $id);
            }
            DB::commit();
            return redirect()->route('organizations.externalReservation.index')->with('success','Data has been saved successfully.');
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
                'subscriber' => $request->input('subscriber'),
                'training'   => $request->input('training'),
                'price_name' => $request->input('price_name'),

            ]);
        $result = view('Organization::externalReservations.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function appendFinalPrice(Request $request){
        try {

            if($request->ajax()){
                $data = $request->all();
                $ScriberT = Customer::where('id', $data['subscriber_id'])->first();

                $price_per_hours = External::where(['external_pricing_id'=>$data['external_pricing_id'],'subscriber_type_id'=>$ScriberT->customerType_id])->first();

                $total =  $data['num_of_hours']  * $price_per_hours->price_per_hour;

                return view('Organization::externalReservations.components.append_finalPrice',compact('total'))->render();
            }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
        return $this->response(500, 'Failed, Please try again later.', 200);
    }

    public function appendEndTime(Request $request){
        try {

            if($request->ajax()){
                $data = $request->all();
                $start_time     = $data['start_time'];
                $num = $request['num_of_hours'];

                $timestamp = strtotime($start_time) + $num*60*60;

                $end_time = date('H:i', $timestamp);

                return view('Organization::externalReservations.components.append_endTime',compact('end_time'))->render();
            }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
        return $this->response(500, 'Failed, Please try again later.', 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'organization_externalReservations_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'ExternalReservation-Delete')
        ){
            DB::beginTransaction();
            try {
                $record =  $trashAction->execute($request);
                if(!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);
                DB::commit();
                return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'externalReservations', 'trashesCount' => $this->countTrashes()]);
            } catch (\Exception $ex) {
                DB::rollBack();
                return $this->response(500, 'Failed, Please try again later.', 200);
            }
        }else
            return abort(401);

    }

    public function destroy(RemoveRequest $request, DestroyAction $destroyAction, $id)
    {
        DB::beginTransaction();
        try {
            if ($id === 1)
                return $this->response(500, 'Failed, You can not delete this record.', 200);
            $record =  $destroyAction->execute($request, $id);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);
            DB::commit();
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'externalReservations', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'externalReservations', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    private function countTrashes()
    {
        return ExternalReservation::onlyTrashed()->count();
    }
}
