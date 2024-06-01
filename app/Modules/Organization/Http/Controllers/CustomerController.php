<?php

namespace Organization\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Models\CustomerData;
use Organization\Models\CustomerInformation;
use Organization\Models\CustomerType;
use Organization\Models\ExternalPayment;
use Organization\Actions\Customer\{
    StoreAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
};
use Organization\Http\Requests\Customer\{
    StoreRequest,
    UpdateRequest,
    RemoveRequest,
    FilterDateRequest
};
use Organization\Exports\Customer\{
    ExportData,
};
use Organization\Models\{
    Customer
};

class CustomerController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Customer-View')
        ){
            return view('Organization::customers.index');

        }else
            return abort(401);
    }

    public function create()
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Customer-Add')
        ){
            $customerTypes = CustomerType::with('information')->get();

            return view('Organization::customers.create',compact('customerTypes'));

        }else
            return abort(401);
    }

    public function store(StoreRequest $request, StoreAction $storeAction)
    {

        DB::beginTransaction();
         try {
        $storeAction->execute($request);
             DB::commit();
             if (is_null($request->input('hotel')))
            return redirect()->route('organizations.customer.index')->with('success','Data has been saved successfully.');
        else
            return redirect()->route('organizations.hotelReservation.create')->with('success','Data has been saved successfully.');

         } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function edit($id)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Customer-Edit')
        ){
            $record                 = Customer::findOrFail($id);
            $customerData           = CustomerData::where('customer_id',$record->id)->get();
            $customerTypes          = CustomerType::with('information')->get();
            $customerInformation    = CustomerInformation::get();

            return view('Organization::customers.edit', compact('record','customerData','customerTypes','customerInformation'));

        }else
            return abort(401);


    }

    public function show($id)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Customer-Show')
        ){
            $record = Customer::findOrFail($id);
            //external reservations remaining amount
            if (ExternalPayment::where('subscriber_id',$record->id)->exists()){
                $remaining_external = 0;
            }else{
                $remaining_external =$record->ExternalReservations->sum('total');
            }
            // hotel reservation remaining amount
            $remaining_hotel = $record->HotelReservations->sum('remainingAmount');

            // Event reservation remaining amount
            $remaining_event = $record->Reservations->sum('remaining_amount');

            // Sport areas subscriptions remaining amount
            $remaining_subscriptions = $record->Subscriptions->sum('payment_balance');

            $total_remaining = $remaining_external + $remaining_hotel + $remaining_event + $remaining_subscriptions;

            return view('Organization::customers.show', compact('record','total_remaining'));

        }else
            return abort(401);



    }


    public function update(Request $request, UpdateAction $updateAction, $id)
    {
        DB::beginTransaction();
        try {
            $updateAction->execute($request, $id);
            DB::commit();
            return redirect()->route('organizations.customer.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function toggle_trobble_maker($id)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Customer-Toggle-TroubleMaker')
        ){
            DB::beginTransaction();
            try {
                $customer = Customer::FindOrFail($id);
                if ($customer->trouble_maker == 0){
                    $customer->trouble_maker = 1;
                }else{

                    $customer->trouble_maker = 0;
                }
                $customer->save();
                DB::commit();

                if ($customer->trouble_maker == 0)
                    return back()->with('success','العميل لم يعد صانع مشاكل');
                else
                    return back()->with('success','المعيل اصبح صانع للمشاكل');

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
        $result = view('Organization::customers.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }
    public function appendInformation(Request $request){
        try {
            if($request->ajax()){
                $data = $request->all();
                $customer_information = CustomerInformation::where(['customerType_id'=>$data['customerType_id']])->get();
                return view('Organization::customers.components.append_information',compact('customer_information'))->render();
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
            return Excel::download(new ExportData($records), 'organization_customers_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Customer-Delete')
        ){
            DB::beginTransaction();
            try {
                $record =  $trashAction->execute($request);
                if(!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);
                DB::commit();
                return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'customers', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'customers', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'customers', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    private function countTrashes()
    {
        return Customer::onlyTrashed()->count();
    }
}
