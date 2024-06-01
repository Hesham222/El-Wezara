<?php

namespace Organization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\Reservation\addMoneyBackAction;
use Organization\Exports\Reservation\ExportData;
use Organization\Http\Requests\Reservation\SupplierPaymentRequest;
use Organization\Models\Customer;
use Organization\Models\CustomerData;
use Organization\Models\CustomerInformation;
use Organization\Models\CustomerType;
use Organization\Models\EventHall;
use Organization\Models\EventType;
use Organization\Models\Hall;
use Organization\Models\Item;
use Organization\Models\ItemVariant;
use Organization\Models\Package;
use Organization\Models\Reservation;
use Organization\Models\ReservationContacts;
use Organization\Models\ReservationSupplier;
use Organization\Models\Supplier;
use Organization\Models\SupplierService;
use Organization\Actions\Reservation\{addPaymentAction,
    addSupplierPaymentAction,
    ConfirmAction,
    StoreAction,
    UpdateAction,
    FilterAction,
    RestoreAction,
    TrashAction,
    DestroyAction};
use Organization\Http\Requests\Reservation\{
    addPayment, StoreRequest, UpdateRequest, FilterDateRequest,
    RemoveRequest,
    addMoneyBackRequest,

};
use Organization\Models\TicketPrice;
use Organization\Models\Vendor;

class ReservationController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-View')
        ){
            return view('Organization::reservations.index');
        }else
            return abort(401);
    }

    public function create()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Add')
        ){
            $halls = Hall::all();
            $eventTypes = EventType::all();
            $services = SupplierService::all();
            $customers = Customer::all();
            $vendors = Vendor::all();
            $ticket_prices = TicketPrice::all();
            $products = Item::select(['id', 'name','final_cost','cost'])->get();
            $variant_item_ids = Item::where('type', 'Variant')->pluck('id');
            $item_variants = ItemVariant::whereIn('item_id', $variant_item_ids)->select(['id', 'name','final_cost' ,'cost'])->get();
            $customerTypes = CustomerType::with('information')->get();

            return view('Organization::reservations.create',compact('halls','customerTypes','customers','vendors','eventTypes','services','ticket_prices','products','item_variants'));
        }else
            return abort(401);
    }
    public function appendInformation(Request $request){
        try {
            if($request->ajax()){
                $data = $request->all();
                $customer_information = CustomerInformation::where(['customerType_id'=>$data['customerType_id']])->get();
                return view('Organization::reservations.components.append_information',compact('customer_information'))->render();
            }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
        return $this->response(500, 'Failed, Please try again later.', 200);
    }
    public function store(Request $request, StoreAction $storeAction)
    {
      // return $request;

        DB::beginTransaction();
        try {
            if ($storeAction->isAreaTaken($request)){
                return redirect()->back()->with('error','... هذه القاعه غير متوفرة في التاريخ والتوقيت الذي اخترته .')->withInput();
            }else{
                $res         =   $storeAction->execute($request);
            }
          if ($res == 0){
              return back()->with('error','بعض من منتجات هذه الحزمة لا تتوافر له منقطه تحضير');
          }
          DB::commit();
            return redirect()->route('organizations.reservation.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function edit($id)
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Edit')
        ){
            $record = Reservation::find($id);

            if (!is_null($record['package_id'])){
                $halls = Hall::all();
                $allEventTypes = EventType::all();
                $services = SupplierService::all();
                $allPackages = Package::all();
                $ReservationHall = EventHall::where('event_type_id',$record->event_type_id)->first();

                $package = Package::find($record->package_id);
                $total = 0;
                foreach ($package->packageSupplierServices as $service){
                    $commissions = ($service->supplierService->price)-(($service->supplierService->club_commission * $service->supplierService->price)/100);
                    $total += $commissions;
                }
                $customers = Customer::all();
                $ticket_prices = TicketPrice::all();
                $vendors = Vendor::all();
                $products = Item::select(['id', 'name','final_cost','cost'])->get();
                $variant_item_ids = Item::where('type', 'Variant')->pluck('id');
                $item_variants = ItemVariant::whereIn('item_id', $variant_item_ids)->select(['id', 'name','final_cost' ,'cost'])->get();
                $customerData           = ReservationContacts::where('reservation_id',$record->id)->get();
                $customerTypes          = CustomerType::with('information')->get();
                $customerInformation    = CustomerInformation::get();
                return view('Organization::reservations.edit',compact('halls','ReservationHall','vendors','record','allEventTypes','services','allPackages','total','customers','ticket_prices','products','item_variants','customerData','customerTypes','customerInformation'));
            }else{

                $halls = Hall::all();
                $allEventTypes = EventType::all();
                $ReservationHall = EventHall::where('event_type_id',$record->event_type_id)->first();
                $services = SupplierService::all();
                $allPackages = Package::all();
//                $package = Package::find($record->package_id);
//                $total = 0;
//                foreach ($package->packageSupplierServices as $service){
//                    $commissions = ($service->supplierService->price)-(($service->supplierService->club_commission * $service->supplierService->price)/100);
//                    $total += $commissions;
//                }
                $customers = Customer::all();
                $ticket_prices = TicketPrice::all();
                $vendors = Vendor::all();
                $products = Item::select(['id', 'name','final_cost','cost'])->get();
                $variant_item_ids = Item::where('type', 'Variant')->pluck('id');
                $item_variants = ItemVariant::whereIn('item_id', $variant_item_ids)->select(['id', 'name','final_cost' ,'cost'])->get();
                $customerData           = ReservationContacts::where('reservation_id',$record->id)->get();
                $customerTypes          = CustomerType::with('information')->get();
                $customerInformation    = CustomerInformation::get();
                return view('Organization::reservations.edit',compact('halls','ReservationHall','vendors','record','allEventTypes','services','allPackages','customers','ticket_prices','products','item_variants','customerData','customerTypes','customerInformation'));
            }


        }else
            return abort(401);
    }

    public function update(Request $request, UpdateAction $updateAction, $id)
    {
       // return $request;
        DB::beginTransaction();
        try {
            $res= $updateAction->execute($request, $id);
            if ($res == 0){
                return back()->with('error','بعض من منتجات هذه الحزمة لا تتوافر له منقطه تحضير');
            }
            DB::commit();
            return redirect()->route('organizations.reservation.index')->with('success','Data has been saved successfully.');
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
        $result = view('Organization::reservations.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'organization_reservations_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Delete')
        ){
            DB::beginTransaction();
            try {
                $record =  $trashAction->execute($request);
                if(!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);
                DB::commit();
                return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'Reservation', 'trashesCount' => $this->countTrashes()]);
            } catch (\Exception $ex) {
                DB::rollBack();
                return $this->response(500, 'Failed, Please try again later.', 200);
            }        }else
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
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'Reservation', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'Reservation', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    private function countTrashes()
    {
        return Reservation::onlyTrashed()->count();
    }

    public function appendPackages(Request $request){
        try {
            if($request->ajax()){
                $data = $request->all();
                $packages = Package::where(['hall_id'=>$data['id']])->select(['id','name'])->get();
                return view('Organization::reservations.components.append_packages',compact('packages'))->render();
            }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
        return $this->response(500, 'Failed, Please try again later.', 200);
    }

    public function appendEvents(Request $request){
        try {
            if($request->ajax()){
                $hall = Hall::find($request->input('id'));
                $events =  $hall->hallEvents(); //$hall->events;

                return view('Organization::reservations.components.append_events',compact('events'))->render();
            }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
        return $this->response(500, 'Failed, Please try again later.', 200);
    }

    public function getPackagePrice(Request $request)
    {
        $package= Package::find($request->id);
        $total = 0;
        foreach ($package->packageSupplierServices as $service){
            $commissions = ($service->supplierService->price)-(($service->supplierService->club_commission * $service->supplierService->price)/100);
            $total += $commissions;
        }
      //  dd($package->final_price);
        return $this->response(200, 'Package Price', 200, [], 0, ['price'=>$package->final_price,'remaining'=>$total]);
    }



    public function getTicketPrice(Request $request)
    {
        $ticketPrice= TicketPrice::find($request->id);
        $total = $ticketPrice->price * $request->number;

        return $this->response(200, 'ticket Price', 200, [], 0, ['price'=>$total]);
    }

    public function getServiceRow()
    {
        $services      = SupplierService::all();

        $results = view('Organization::reservations.components.service.row',compact('services'),
            [
            ])->render();

        return $this->response(200, 'Service Row', 200, [], 0, ['responseHTML' => $results]);
    }



    public function getContactRow()
    {
        $results = view('Organization::reservations.components.contact.row')->render();

        return $this->response(200, 'Contact Row', 200, [], 0, ['responseHTML' => $results]);
    }

    public function payment($id){

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Add-Payment')
        ){
            $record = Reservation::find($id);
            return view('Organization::reservations.payment',compact('record'));
        }else
            return abort(401);
    }

    public function addPayment(addPayment $request,addPaymentAction $action)
    {
        DB::beginTransaction();
        try {
            $action->execute($request);
            DB::commit();
            return redirect()->route('organizations.reservation.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }
    public function moneyBack($id){

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Add-Payment')
        ){
            $record = Reservation::find($id);
            return view('Organization::reservations.moneyBack',compact('record'));
        }else
            return abort(401);
    }
    public function addMoneyBack(addMoneyBackRequest $request,addMoneyBackAction $action)
    {
        DB::beginTransaction();
        try {
            $action->execute($request);
            DB::commit();
            return redirect()->route('organizations.reservation.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }
    public function getSupplierRemainingAmount(Request $request)
    {
        $total = 0;
        if($request->input('remaining')){
            foreach ($request->input('remaining') as $item){
                $service = SupplierService::find($item);
                $commission = ($service->price) - (($service->club_commission * $service->price) / 100);
                $total += $commission;
            }
        }
        return $this->response(200, 'remaining', 200, [], 0,$total);

    }

    public function supplierPayment($id){

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Add-SupplierPayment')
        ){
            $record = Reservation::find($id);
            return view('Organization::reservations.supplier-payment',compact('record'));
        }else
            return abort(401);
    }

    public function supplierRemaining(Request $request){
        $object = ReservationSupplier::where('vendor_id',$request->input('id'))->where('reservation_id',$request->input('reservation_id'))->first();
        $total = $object->remaining_amount;
        return $this->response(200, 'remaining', 200, [], 0,$total);
    }

    public function addSupplierPayment(SupplierPaymentRequest $request,addSupplierPaymentAction $action)
    {
        DB::beginTransaction();
        try {
            $action->execute($request);
            DB::commit();
            return redirect()->route('organizations.reservation.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }


    public function confirm($id,ConfirmAction $action)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Confirm-Reservation')
        ){
            DB::beginTransaction();
            try {
                $res = $action->execute($id);

                if ($res == 0){
                    return back()->with('error','بعض من منتجات هذه الحزمة لا تتوافر له منقطه تحضير');
                }
                DB::commit();
                return redirect()->route('organizations.reservation.index')->with('success','تم تأكيد الحجز بنجاح');
            } catch (\Exception $exception) {
                DB::rollback();
                return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
            }
        }else
            return abort(401);
    }



    public function cancel($id)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Cancel-Reservation')
        ){
            DB::beginTransaction();
            try {
                $record                                 = Reservation::FindOrFail($id);
                $record->status = "cancelled";
                $record->save();
                DB::commit();
                return redirect()->route('organizations.reservation.index')->with('success','تم اغاء الحجز بنجاح');
            } catch (\Exception $exception) {
                DB::rollback();
                return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
            }        }else
            return abort(401);
    }
    public function confirmDiscount($id)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Cancel-Reservation')
        ){
            DB::beginTransaction();
            try {
                $record                                 = Reservation::FindOrFail($id);
                $record->discount = 1;
                $price = $record->actual_price;
                $remaining_amount = $record->remaining_amount;
                $discount_type = $record->discount_type;
                $discount_number = $record->discount_number;

                if ($discount_type == 'numeric'){

                    if ($price >= $discount_number){
                        $new_actual = $price - $discount_number;
                        $new_remaining = $remaining_amount - $discount_number;
                    }else{
                        return false;
                    }

                }else{
                    if ($price >= $discount_number){
                        $new_actual     = $price - ( ($discount_number / 100 ) * $price);
                        $new_remaining  = $remaining_amount - ( ($discount_number / 100 ) * $remaining_amount);
                    }else{
                        return false;
                    }
                }
                $record->actual_price       = $new_actual;
                $record->remaining_amount   = $new_remaining;
                $record->save();
                DB::commit();
                return redirect()->route('organizations.reservation.index')->with('success','تم قبول الخصم بنجاح');
            } catch (\Exception $exception) {
                DB::rollback();
                return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
            }        }else
            return abort(401);
    }

    public function cancelDiscount($id)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EventReservation-Cancel-Reservation')
        ){
            DB::beginTransaction();
            try {
                $record                                 = Reservation::FindOrFail($id);
                $record->discount = 2;
                $record->save();
                DB::commit();
                return redirect()->route('organizations.reservation.index')->with('success','تم رفض الخصم بنجاح');
            } catch (\Exception $exception) {
                DB::rollback();
                return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
            }        }else
            return abort(401);
    }
    public function getProductRow()
    {
        $products = Item::select(['id', 'name','final_cost','cost'])->get();
        $variant_item_ids = Item::where('type', 'Variant')->pluck('id');
        $item_variants = ItemVariant::whereIn('item_id', $variant_item_ids)->select(['id', 'name','final_cost' ,'cost'])->get();

        $results = view('Organization::reservations.components.product.row',compact('products','item_variants'),
            [
            ])->render();

        return $this->response(200, 'Product Row', 200, [], 0, ['responseHTML' => $results]);

    }
    public function getServicePrice(Request $request)
    {
        $price= SupplierService::find($request->id)->price;
        return $this->response(200, 'Service Price', 200, [], 0, ['price'=>$price]);
    }
    public function getProductPrice(Request $request)
    {


        $id = strtok($request->id, ',');
       // dd($request->package_id);

        $type = substr($request->id, strpos($request->id, ",") + 1);
        if ($type == "Item"){
            $price= (Item::find($id)->price) ;
            //dd(Item::find($id)->price);
           // dd($request->cap);
        }else{
            $price= (ItemVariant::find($id)->price);
        }

        return $this->response(200, 'Product Price', 200, [], 0, ['price'=>$price]);
    }

    public function print_reservation($id)
    {
        $reservation = Reservation::FindOrFail($id);
        $ReservationHall = EventHall::where('event_type_id',$reservation->event_type_id)->first();

        //  return $reservation->package->PackageSupplierService;
        if ($reservation->customerType_id  == null){
            return redirect()->back()->with('error','..........برجاءاضف بيانات المتعاقد')->withInput();
        }else{
            return view('Organization::reservations.print_reservation',compact('reservation','ReservationHall'));

        }



    }

}
