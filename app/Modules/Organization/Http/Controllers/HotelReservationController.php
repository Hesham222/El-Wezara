<?php

namespace Organization\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\HotelReservation\CheckInAction;
use Organization\Actions\HotelReservation\StorePaymentAction;
use Organization\Actions\HotelReservation\UpdateInvoiceAction;
use Organization\Actions\HotelReservation\UpdateInvoiceReservationAction;
use Organization\Actions\HotelReservation\UpdateReservationDatesAction;
use Organization\Http\Requests\HotelReservation\CheckInRequest;
use Organization\Http\Requests\HotelReservation\StorePaymentRequest;
use Organization\Http\Requests\HotelReservation\UpdateInvoiceRequest;
use Organization\Http\Requests\HotelReservation\UpdateInvoiceReservationRequest;
use Organization\Models\Customer;
use Organization\Models\CustomerInformation;
use Organization\Models\CustomerType;
use Organization\Models\Hotel;
use Organization\Models\HotelReservationInnvoice;
use Organization\Models\ParentRoom;
use Organization\Models\RoomDamage;
use Organization\Models\RoomDayPricing;
use Organization\Models\RoomPricing;
use Organization\Models\Rooms;
use Organization\Models\RoomType;
use Organization\Actions\HotelReservation\{
    StoreAction,
    AccountStoreAction,
    ChildrenStoreAction,
    AccountUpdateAction,
    ChildrenUpdateAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
    StoreDamageAction
};
use Organization\Http\Requests\HotelReservation\{
    StoreRequest,
    UpdateRequest,
    RemoveRequest,
    FilterDateRequest,
    StoreDamageRequest,
};
use Organization\Exports\HotelReservation\{
    ExportData,
};
use Organization\Models\{
    HotelReservation
};
use Organization\Models\Supplier;

class HotelReservationController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'HotelReservation-View')
        ){
            return view('Organization::hotelReservations.index');
        }else
            return abort(401);
    }

    public function create()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'HotelReservation-Add')
        ){
            $rooms                  = Rooms::where('status','Available')->get();
            $customers              = Customer::select(['id','name'])->get();
            $roomTypes              = RoomType::select(['id','name'])->get();
            $hotels                 = Hotel::has('ParentRooms')->select(['id','name'])->get();
            $customerTypes = CustomerType::with('information')->get();
            $suppliers = Supplier::all();
            return view('Organization::hotelReservations.create',compact('roomTypes','rooms','customers','hotels','customerTypes','suppliers'));
        }else
            return abort(401);
    }

    public function getAccountRow()
    {
        $results = view('Organization::hotelReservations.components.accounts.row',
            [

            ])->render();

        return $this->response(200, 'Account Row', 200, [], 0, ['responseHTML' => $results]);
    }

    public function getChildrenRow()
    {


        $results = view('Organization::hotelReservations.components.children.row',
            [

            ])->render();

        return $this->response(200, 'Children Row', 200, [], 0, ['responseHTML' => $results]);
    }

    public function store(StoreRequest $request, StoreAction $storeAction /*,AccountStoreAction $accountStoreAction,ChildrenStoreAction $childrenStoreAction*/)
    {
        DB::beginTransaction();

        try {
            if ($storeAction->isAreaTaken($request)){
                return redirect()->back()->with('error','... هذه الغرفه غير متوفرة في التاريخ الذي اخترته .')->withInput();
            }else{
                $record         =   $storeAction->execute($request);
            }
             //$account        =   $accountStoreAction->execute($request,$record);
             /*if($account){
                 return redirect()->route('organizations.hotelReservation.index')->with('error','يجب أن تسجل عدد بيانات الاشخاص الآخرين بشكل صحيح مراعيا نوع الغرفه وعدد السراير المضافه .');
             }*/
             //$children       =   $childrenStoreAction->execute($request,$record);
            /*if(!$children){
                return redirect()->route('organizations.hotelReservation.index')->with('error','يجب أن تسجل عدد بيانات الاطفال بشكل صحيح مراعيا عدد الاطفال اللذي قمت بادخاله .');
            }*/
            DB::commit();
            return redirect()->route('organizations.hotelReservation.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function edit($id)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'HotelReservation-Edit')
        ){
            $record                 = HotelReservation::findOrFail($id);
            $rooms                  = Rooms::where('status','Available')->get();
            $customers              = Customer::select(['id','name'])->get();
            $roomTypes              = RoomType::select(['id','name'])->get();
            $hotels                 = Hotel::select(['id','name'])->get();
            $suppliers = Supplier::all();
            $extraBeds = 0;
            if (!is_null($record->num_of_extra_beds))
                $extraBeds = $record->num_of_extra_beds;

            return view('Organization::hotelReservations.edit', compact('record','roomTypes','rooms','customers','extraBeds','hotels','suppliers'));
        }else
            return abort(401);
    }

    public function update(UpdateRequest $request, UpdateAction $updateAction,AccountUpdateAction $accountUpdateAction,ChildrenUpdateAction $childrenUpdateAction, $id)
    {
        DB::beginTransaction();
        try {
            $record         =   $updateAction->execute($request, $id);
            $accountUpdateAction->execute($request,$record);
            $childrenUpdateAction->execute($request,$record);
            DB::commit();
            return redirect()->route('organizations.hotelReservation.index')->with('success','Data has been saved successfully.');
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
        $result = view('Organization::hotelReservations.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function appendNumberOfNights(Request $request){
        try {
            if($request->ajax()){
                $data = $request->all();
                $arrivalDate    = $data['arrival_date'];
                $departureDate  = $data['departure_date'];
                if ($arrivalDate == $departureDate)
                    $num_of_nights = 1;
                else
                    $num_of_nights = round((strtotime($departureDate) - strtotime($arrivalDate))/86400, 1);

                return view('Organization::hotelReservations.components.append_num_of_nights',compact('num_of_nights'))->render();
            }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
        return $this->response(500, 'Failed, Please try again later.', 200);
    }

    public function appendDepartureDuration(Request $request){
        try {
            if($request->ajax()){
                $data = $request->all();
                $numberNights   = $data['num_of_nights'];
                $arrivalDate    = Carbon::parse($request['arrival_date']);

                $departureDate = $arrivalDate->addDays($numberNights);
                $departure_Date = $departureDate->toDateString();

                return view('Organization::hotelReservations.components.append_departure_date',compact('departure_Date'))->render();
            }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
        return $this->response(500, 'Failed, Please try again later.', 200);
    }

    public function appendRooms(Request $request){
        try {

            if($request->ajax()){
                $arrivalDate    = $request->input('arrival_date');
                $departureDate  = $request->input('departure_date');
                $customer_id = $request->input('customer_id');
                $roomType_id = $request->input('roomType_id');
                $hotel_id  = $request->input('hotel_id');

                $customer_type = Customer::select('customerType_id')->where('id',$customer_id)->pluck('customerType_id');

               // $day_pricing = RoomDayPricing::where(['customerType_id'=>$customer_type,'roomType_id'=>$roomType_id])->get();

                if ($arrivalDate == $departureDate)
                {
                    $parentRooms = ParentRoom::where('hotel_id',$hotel_id)->whereHas('DayPricings',function ($q) use ($customer_type,$roomType_id)
                    {
                        $q->where(['customerType_id'=>$customer_type,'roomType_id'=>$roomType_id]);
                    })->get();
                }
                else
                {
                    $parentRooms = ParentRoom::where('hotel_id',$hotel_id)->whereHas('Pricings',function ($q) use ($customer_type,$roomType_id)
                    {
                        $q->where(['customerType_id'=>$customer_type,'roomType_id'=>$roomType_id]);
                    })->get();
                }

                return view('Organization::hotelReservations.components.append_room',compact('parentRooms'))->render();
            }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
        return $this->response(500, 'Failed, Please try again later.', 200);
    }

    public function appendPriceNight(Request $request){
        try {

            if($request->ajax()){

                 $customer_id       = $request->input('customer_id');
                 $roomType_id       = $request->input('roomType_id');
                 $arrivalDate       = $request->input('arrival_date');
                 $departureDate     = $request->input('departure_date');
                 $hotel_id          = $request->input('hotel');
                 $room_id           = $request->input('room_id');


                $parent_room = ParentRoom::where('hotel_id',$hotel_id)->whereHas('Rooms',function ($query) use ($room_id){
                    return $query->where('id',$room_id);
                })->first();
                //dd($parent_room->id);

                 $customerType = Customer::where('id',$customer_id)->select('customerType_id')->get();

                foreach ($customerType as $type){
                    $customer_type = $type->customerType_id;
                }

                if ($arrivalDate == $departureDate)
                    $day_price = RoomDayPricing::where(['customerType_id'=>$customer_type,'roomType_id'=>$roomType_id ,'parentRoom_id'=>$parent_room->id])->select(['price'])->get();
                else
                    $day_price = RoomPricing::where(['customerType_id'=>$customer_type,'roomType_id'=>$roomType_id,'parentRoom_id'=>$parent_room->id])->select(['price'])->get();


                foreach ($day_price as $dayPrice){
                    $price = $dayPrice->price;
                }

                return view('Organization::hotelReservations.components.append_price_night',compact('price'))->render();
            }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
        return $this->response(500, 'Failed, Please try again later.', 200);
    }

    public function appendTotalPriceNight(Request $request){
        try {

            if($request->ajax()){

                $arrivalDate        = $request['arrival_date'];
                $departureDate      = $request['departure_date'];
                $customer_id        = $request->input('customer_id');
                $roomType_id        = $request->input('roomType_id');
                $hotel_id           = $request->input('hotel');
                $room_id            = $request->input('room_id');

                $parent_room = ParentRoom::where('hotel_id',$hotel_id)->whereHas('Rooms',function ($query) use ($room_id){
                    return $query->where('id',$room_id);
                })->first();

                //get number of night
                if ($arrivalDate == $departureDate)
                    $num_of_nights = 1;
                else
                    $num_of_nights = round((strtotime($departureDate) - strtotime($arrivalDate))/86400, 1);

                //get price for night
                $customerType = Customer::where('id',$customer_id)->select('customerType_id')->get();

                foreach ($customerType as $type){
                    $customer_type = $type->customerType_id;
                }

                if ($arrivalDate == $departureDate)
                    $day_price = RoomDayPricing::where(['customerType_id'=>$customer_type,'roomType_id'=>$roomType_id,'parentRoom_id'=>$parent_room->id])->select(['price'])->get();
                else
                    $day_price = RoomPricing::where(['customerType_id'=>$customer_type,'roomType_id'=>$roomType_id,'parentRoom_id'=>$parent_room->id])->select(['price'])->get();

                foreach ($day_price as $dayPrice){
                    $price = $dayPrice->price;
                }
                //get total price for this duration

                $total = $num_of_nights * $price;

                return view('Organization::hotelReservations.components.append_total_price_night',compact('total'))->render();
            }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
        return $this->response(500, 'Failed, Please try again later.', 200);
    }

    public function appendTotalPrice(Request $request){
        try {

            if($request->ajax()){
                $arrivalDate        = $request['arrival_date'];
                $departureDate      = $request['departure_date'];
                $hotel_id           = $request->input('hotel');
                $room_id            = $request->input('room_id');


                $parent_room = ParentRoom::where('hotel_id',$hotel_id)->whereHas('Rooms',function ($query) use ($room_id){
                    return $query->where('id',$room_id);
                })->first();


                if ($arrivalDate == $departureDate)
                    $num_of_nights = 1;
                else
                    $num_of_nights = $request['num_of_nights'];

                $customer_id   = $request->input('customer_id');
                $roomType_id   = $request->input('roomType_id');

                //get price for night
                $customerType = Customer::where('id',$customer_id)->select('customerType_id')->get();

                foreach ($customerType as $type){
                    $customer_type = $type->customerType_id;
                }

                if ($arrivalDate == $departureDate)
                    $day_price = RoomDayPricing::where(['customerType_id'=>$customer_type,'roomType_id'=>$roomType_id,'parentRoom_id'=>$parent_room->id])->select(['price'])->get();
                else
                    $day_price = RoomPricing::where(['customerType_id'=>$customer_type,'roomType_id'=>$roomType_id,'parentRoom_id'=>$parent_room->id])->select(['price'])->get();

                foreach ($day_price as $dayPrice){
                    $price = $dayPrice->price;
                }
                //get total price for this duration

                $total = $num_of_nights * $price;

                return view('Organization::hotelReservations.components.append_total_price_night',compact('total'))->render();
            }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
        return $this->response(500, 'Failed, Please try again later.', 200);
    }

    public function appendFinalPrice(Request $request){
        try {

            if($request->ajax()){

                $numOfBeds     = $request['num_of_extra_beds'];
                $numOfChildren = $request['num_of_children'];
                $arrivalDate   = $request['arrival_date'];
                $departureDate = $request['departure_date'];
                $customer_id   = $request->input('customer_id');
                $roomType_id   = $request->input('roomType_id');
                $hotel_id           = $request->input('hotel');
                $room_id            = $request->input('room_id');


                $parent_room = ParentRoom::where('hotel_id',$hotel_id)->whereHas('Rooms',function ($query) use ($room_id){
                    return $query->where('id',$room_id);
                })->first();

                //get number of night
                if ($arrivalDate == $departureDate)
                    $num_of_nights = 1;
                else
                    $num_of_nights = round((strtotime($departureDate) - strtotime($arrivalDate))/86400, 1);


                $customerType = Customer::where('id',$customer_id)->select('customerType_id')->get();

                foreach ($customerType as $type){
                    $customer_type = $type->customerType_id;
                }

                if ($arrivalDate == $departureDate)
                    $day_price = RoomDayPricing::where(['customerType_id'=>$customer_type,'roomType_id'=>$roomType_id,'parentRoom_id'=>$parent_room->id])->select(['price'])->get();
                else
                    $day_price = RoomPricing::where(['customerType_id'=>$customer_type,'roomType_id'=>$roomType_id,'parentRoom_id'=>$parent_room->id])->select(['price'])->get();

                foreach ($day_price as $dayPrice){
                    $price = $dayPrice->price;
                }
                //get total price for this duration

                $total = $num_of_nights * $price;

                if ($arrivalDate == $departureDate)
                {
                    $parentRooms = ParentRoom::whereHas('DayPricings',function ($q) use ($customer_type,$roomType_id)
                    {
                        $q->where(['customerType_id'=>$customer_type,'roomType_id'=>$roomType_id]);
                    })->select(['child_price','extra_price'])->get();
                }
                else
                {
                    $parentRooms = ParentRoom::whereHas('Pricings',function ($q) use ($customer_type,$roomType_id)
                    {
                        $q->where(['customerType_id'=>$customer_type,'roomType_id'=>$roomType_id]);
                    })->select(['child_price','extra_price'])->get();
                }


                foreach ($parentRooms as $parentRoom){
                    $child_price = $parentRoom->child_price;
                }
                foreach ($parentRooms as $parentRoom){
                    $extra_price = $parentRoom->extra_price;
                }

                //get final price
                $final_price = $child_price * $numOfChildren + $extra_price *$numOfBeds +$total;


                return view('Organization::hotelReservations.components.append_final_price',compact('final_price'))->render();
            }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
        return $this->response(500, 'Failed, Please try again later.', 200);
    }

    public function appendFinalPriceNight(Request $request){
        try {

            if($request->ajax()){

                $numOfBeds     = $request['num_of_extra_beds'];
                $numOfChildren = $request['num_of_children'];
                $arrivalDate   = $request['arrival_date'];
                $departureDate = $request['departure_date'];
                $hotel_id           = $request->input('hotel');
                $room_id            = $request->input('room_id');


                $parent_room = ParentRoom::where('hotel_id',$hotel_id)->whereHas('Rooms',function ($query) use ($room_id){
                    return $query->where('id',$room_id);
                })->first();


                if ($arrivalDate == $departureDate)
                    $num_of_nights = 1;
                else
                    $num_of_nights = $request['num_of_nights'];

                $customer_id   = $request->input('customer_id');
                $roomType_id   = $request->input('roomType_id');


                $customerType = Customer::where('id',$customer_id)->select('customerType_id')->get();

                foreach ($customerType as $type){
                    $customer_type = $type->customerType_id;
                }

                if ($arrivalDate == $departureDate)
                    $day_price = RoomDayPricing::where(['customerType_id'=>$customer_type,'roomType_id'=>$roomType_id,'parentRoom_id'=>$parent_room->id])->select(['price'])->get();
                else
                    $day_price = RoomPricing::where(['customerType_id'=>$customer_type,'roomType_id'=>$roomType_id,'parentRoom_id'=>$parent_room->id])->select(['price'])->get();

                foreach ($day_price as $dayPrice){
                    $price = $dayPrice->price;
                }
                //get total price for this duration

                 $total = $num_of_nights * $price;

                if ($arrivalDate == $departureDate)
                {
                    $parentRooms = ParentRoom::whereHas('DayPricings',function ($q) use ($customer_type,$roomType_id,$parent_room)
                    {
                        $q->where(['customerType_id'=>$customer_type,'roomType_id'=>$roomType_id,'parentRoom_id'=>$parent_room->id]);
                    })->select(['child_price','extra_price'])->get();
                }
                else
                {
                    $parentRooms = ParentRoom::whereHas('Pricings',function ($q) use ($customer_type,$roomType_id,$parent_room)
                    {
                        $q->where(['customerType_id'=>$customer_type,'roomType_id'=>$roomType_id,'parentRoom_id'=>$parent_room->id]);
                    })->select(['child_price','extra_price'])->get();
                }


                foreach ($parentRooms as $parentRoom){
                    $child_price = $parentRoom->child_price;
                }
                foreach ($parentRooms as $parentRoom){
                    $extra_price = $parentRoom->extra_price;
                }

                //get final price
                $final_price = ($child_price * $numOfChildren) + ($extra_price *$numOfBeds) +$total;


                return view('Organization::hotelReservations.components.append_final_price',compact('final_price'))->render();
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
            return Excel::download(new ExportData($records), 'organization_hotel_Reservations_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'HotelReservation-Delete')
        ){
            DB::beginTransaction();
            try {
                $record =  $trashAction->execute($request);
                if(!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);
                DB::commit();
                return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'hotelReservations', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'hotelReservations', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'hotelReservations', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    public function checkIn(CheckInRequest $request, CheckInAction $action)
    {
        DB::beginTransaction();
        try {
            $record = $action->execute($request);
            if(is_null($record))
                return $this->response(500, 'Failed, The reservation already checked in', 200);

            DB::commit();
            return $this->response(200, 'Data has been saved successfully', 200);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    public function invoices($id)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'HotelReservation-View-Invoices')
        ){
            $record = HotelReservation::findOrFail($id);
            $reservationIds = HotelReservation::select('id')->where([ ['checkIn',1],['id','!=',$id] ])->pluck('id')->toArray();
            if ($record->checkIn == 1)
            {
                foreach ($record->invoices as $invoice)
                {
                    if ($invoice->status == "Not Confirmed" && $invoice->invoice_date <= date('Y-m-d'))
                    {
                        $invoice->status = "System Confirmed";
                        $invoice->save();
                    }
                }
            }
            return view('Organization::hotelReservations.invoices', compact('record','reservationIds'));
        }else
            return abort(401);
    }

    public function payments($id)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'HotelReservation-View-Payments')
        ){
            $record = HotelReservation::findOrFail($id);
            return view('Organization::hotelReservations.payments', compact('record'));
        }else
            return abort(401);
    }

    public function createPayment($id)
    {
        $record = HotelReservation::findOrFail($id);
        if ($record->remainingAmount > 0)
            return view('Organization::hotelReservations.createPayment', compact('record','id'));
        else
            abort(404);
    }

    public function storePayment(StorePaymentRequest $request, StorePaymentAction $action)
    {
        DB::beginTransaction();
        try {
            $record = $action->execute($request);
            DB::commit();
            return redirect()->route('organizations.hotelReservation.payments',$record->hotel_reservation_id)->with('success','Data has been saved successfully.');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function damage($id)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'HotelReservation-Add-Damage')
        ){
            $record = HotelReservation::findOrFail($id);
            return view('Organization::hotelReservations.damage', compact('record'));
        }else
            return abort(401);
    }

    public function damages($id)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'HotelReservation-View-Damages')
        ){
            $records = RoomDamage::where('hotelReservation_id',$id)->get();
            return view('Organization::hotelReservations.damages', compact('records'));
        }else
            return abort(401);
    }

    public function StoreDamage(StoreDamageRequest $request, StoreDamageAction $action)
    {
        DB::beginTransaction();
        try {
            $record = $action->execute($request);
            HotelReservationInnvoice::create([
               'hotel_reservation_id' =>  $record->hotelReservation_id,
               'model_type' =>  'RoomDamage',
               'model_id' =>  $record->id,
               'amount' =>  $record->amount,

            ]);
            DB::commit();
            return redirect()->route('organizations.hotelReservation.damages',$record->hotelReservation_id)->with('success','Data has been saved successfully.');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function editInvoice($id)
    {
        $record = HotelReservationInnvoice::findOrFail($id);
        $extraPersonPrice = $record->hotelReservation->Room->ParentRoom->extra_price;
        $extraKidPrice = $record->hotelReservation->Room->ParentRoom->child_price;
        return view('Organization::hotelReservations.editInvoice', compact('record','extraKidPrice','extraPersonPrice'));
    }

    public function updateInvoice(UpdateInvoiceRequest $request,UpdateInvoiceAction $invoiceAction,$id)
    {
        DB::beginTransaction();
        try {
            $record = $invoiceAction->execute($request,$id);
            DB::commit();
            return redirect()->route('organizations.hotelReservation.invoices',$record->hotel_reservation_id)->with('success','Data has been saved successfully.');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function confirmInvoice($id)
    {
        $record = HotelReservationInnvoice::findOrFail($id);
        $record->status = 'Admin Confirmed';
        $record->save();
        return redirect()->route('organizations.hotelReservation.invoices',$record->hotel_reservation_id)->with('success','Data has been saved successfully.');
    }

    public function editDates($id)
    {
        $record = HotelReservation::findOrFail($id);
        return view('Organization::hotelReservations.editDates', compact('record'));
    }

    public function updateDates(Request $request, UpdateReservationDatesAction $reservationDates, $id)
    {
        DB::beginTransaction();
        try {
            $reservationDates->execute($request,$id);
            DB::commit();
            return redirect()->route('organizations.hotelReservation.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function changeInvoiceReservation(UpdateInvoiceReservationRequest $request, UpdateInvoiceReservationAction $reservationInvoice)
    {
        DB::beginTransaction();
        try {
            $record = $reservationInvoice->execute($request);
            DB::commit();
            return $this->response(200, 'Invoice moved successfully.', 200, [], $record);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    private function countTrashes()
    {
        return HotelReservation::onlyTrashed()->count();
    }
}
