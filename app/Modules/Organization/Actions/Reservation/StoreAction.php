<?php
namespace Organization\Actions\Reservation;
use Admin\Models\Service;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Organization\Models\{EventHall,
    EventType,
    Item,
    ItemVariant,
    OrderItem,
    Package,
    PackageItem,
    PackageSupplierService,
    PreparationArea,
    PreparationAreaCategory,
    Reservation,
    ReservationSupplier,
    ReservationSupplierService,
    SubscribersType,
    SupplierService,
    TicketPrice};
use Organization\Models\CustomerData;
use Organization\Models\ReservationContacts;
use Organization\Models\ReservationProduct;

class StoreAction
{
    public function execute(Request $request)
    {

            $record =  Reservation::create([
                'contact_name'              => $request->input('name'),
                'contact_email'             => $request->input('email'),
                'contact_phone'             => $request->input('phone'),
                'contact_title'             => $request->input('title'),
                'contact_national_id'       => $request->input('national_id'),
                'contact_address'           => $request->input('address'),
                'package_id'                => $request->input('package_id'),
                'event_type_id'             => $request->input('event_id'),
                'booking_date'              => $request->input('booking_date'),
                'payment_due_date'          => $request->input('due_date'),
                'from'                      => $request->input('from'),
                'to'                        => $request->input('to'),
                'remaining_amount'          => $request->input('remaining_amount'),
                'actual_price'              => $request->input('actual_price'),
                'paid_amount'               => $request->input('paid_amount'),
                'discount_type'             => $request->input('discount_type'),
                'discount_number'           => $request->input('discount_number'),
                'customer_id'               => $request->input('customer'),
                'customerType_id'               => $request->input('customerType_id'),
                'supplier_remaining_amount' =>  $request->input('supplier_remaining_amount'),
                'vendor_id'          => ($request->has('isVendor'))?$request->input('vendor'):null,
            ]);

        if(!is_null($request['attachment']))
        {
            $file               = FileTrait::storeMultiple($request->file('attachment'),'reservation_contacts');
            foreach ($request['attachment'] as $key => $value) {

                if(!empty($value)){

                    $data = new ReservationContacts();
                    $data->reservation_id          = $record->id;
                    $data->customerType_id      = $record->customerType_id ;
                    $data->attachment           = $file[$key];
                    if(isset($request['text'][$key])){
                        $data->text                 = $request['text'][$key];
                    }
                    $data->save();
                }
            }
        }else{
            if (!is_null($request['text']))
            {
                if(($request['attachment'])){
                    $file               = FileTrait::storeMultiple($request->file('attachment'),'reservation_contacts');
                }
                foreach ($request['text'] as $key => $value) {

                    if(!empty($value)){

                        $data = new ReservationContacts();
                        $data->reservation_id          = $record->id;
                        $data->customerType_id      = $record->customerType_id ;
                        $data->text                 = $value;
                        if(isset($request['attachment'][$key])){
                            $data->attachment           = $file[$key];
                        }
                        $data->save();
                    }
                }
            }
        }

        if ($request->has('ticket_price_id') && $request->input('ticket_price_id') != 0 && $request->input('number_of_tickets') >0)
        {
            $ticket_price = TicketPrice::FindOrFail($request->input('ticket_price_id'));
            $ticket_amount = $request->input('number_of_tickets') * $ticket_price->price;
            $record->ticket_price_id  = $ticket_price->id;
            $record->number_of_tickets = $request->input('number_of_tickets');
            $record->remaining_tickets = $request->input('number_of_tickets');
            $record->tickets_amount = $ticket_amount;
            $record->save();
        }



        // add items to prep areas
//        $package = Package::FindOrFail($request->input('package_id'));
//
//        foreach ($package->packeage_products as $packeage_product){
//
//            if ($packeage_product->component_type =="Item"){
//
//                $ing  = Item::FindOrFail($packeage_product->component_id);
//
//                $item_category_id = $ing->menu_category_id;
//                $prep_area = PreparationAreaCategory::where('category_id',$item_category_id)->first();
//                if (!$prep_area)
//                    return 0;
//
//
//                // get check this item can preperation area ings
////                $main_prep_area = PreparationArea::FindOrFail($prep_area->area_id);
////
////                if (!$main_prep_area->checkItem($ing,$packeage_product->quantity)){
////                    return 0;
////                }
//
////                OrderItem::create(
////                    [
////                        'component_type'=>'Item',
////                        'component_id'=>$ing->id,
////                        //'order_id' => $record->id,
////                        'quantity'=>$packeage_product->quantity,
////                        'amount'=>$packeage_product->price,
////                        'preparation_area_id' => $prep_area->area_id,
////                        'reservation_id' => $record->id,
////                    ]
////                );
//
//            }else{
//
//
//                $ing  = ItemVariant::FindOrFail($packeage_product->component_id);
//
//                $item_category_id = $ing->item->menu_category_id;
//                $prep_area = PreparationAreaCategory::where('category_id',$item_category_id)->first();
//                if (!$prep_area)
//                    return 0;
//
//
//
//                // get check this item can preperation area ings
////                $main_prep_area = PreparationArea::FindOrFail($prep_area->area_id);
////
////                if (!$main_prep_area->checkItem($ing,$packeage_product->quantity)){
////                    return 0;
////                }
//
////                OrderItem::create(
////                    [
////                        'component_type'=>'Item Variant',
////                        'component_id'=>$ing->id,
////                        //'order_id' => $record->id,
////                        'quantity'=>$packeage_product->quantity,
////                        'amount'=>$packeage_product->price,
////                        'preparation_area_id' => $prep_area->area_id,
////                        'reservation_id' => $record->id,
////                    ]
////                );
//
//            }
//
//        }


        for ($i=0;$i<count($request->input('products'));$i++)
        {
            $new_prdocut = new ReservationProduct();
            $new_prdocut->reservation_id = $record->id;
            $new_prdocut->quantity = $request->input('product_quantity')[$i];
            $new_prdocut->description = $request->input('description_product')[$i];

            $id = strtok($request->input('products')[$i], ',');
            $type = substr($request->input('products')[$i], strpos($request->input('products')[$i], ",") + 1);

            $new_prdocut->price = $request->input('product_price')[$i];


            $new_prdocut->component_type = $type;
            $new_prdocut->component_id = $id;
            $new_prdocut->save();

        }




        $i  =   0 ;
        foreach ($request->input('services') as $service_id)
        {
            ReservationSupplierService::create([
                'quantity' =>$request->input('service_quantity')[$i],
                'description' =>$request->input('description_service')[$i],
                'price'=>$request->input('service_price')[$i++],
                'reservation_id' => $record->id,
                'supplier_service_id' => $service_id,
            ]);

            $service = SupplierService::find($service_id);
            $check = ReservationSupplier::where('vendor_id',$service->supplier->id)->where('reservation_id',$record->id)->first();
            $remaining_amount = ($service->price)-(($service->price)*($service->club_commission))/100;

            if(!$check){
                ReservationSupplier::create([
                    'reservation_id'    => $record->id,
                    'vendor_id'       => $service->supplier->id,
                    'paid_amount'       => 0,
                    'remaining_amount'  => $remaining_amount
                ]);

            }
            else{
                $check->remaining_amount +=$remaining_amount;
                $check->save();
            }
        }

        if (!is_null($request['package_id'])){
            $package = Package::find($record->package_id);
            foreach ($package->packageSupplierServices as $object){
                $packageService = $object->supplierService;
                $check = ReservationSupplier::where('vendor_id',$packageService->id)->where('reservation_id',$record->id)->first();
                $remaining_amount = ($packageService->price)-(($packageService->price)*($packageService->club_commission))/100;
                if(!$check){
                    ReservationSupplier::create([
                        'reservation_id'    => $record->id,
                        'vendor_id'       => $packageService->supplier->id,
                        'paid_amount'       => 0,
                        'remaining_amount'  => $remaining_amount
                    ]);
                }
                else{
                    $check->remaining_amount +=$remaining_amount;
                    $check->save();
                }
            }
            return 1;

        }
        return 1;


    }
    public function isAreaTaken($request)
    {
        $from           = $request['from'];
        $to             = $request['to'];
        $reservations   = Reservation::where(['event_type_id'=> $request->input('event_id') ,'booking_date'=> $request->input('booking_date')])->get();
        //dd($reservations) ;
        if (
            $reservations->where('from', '>=', $from)->where('from', '<', $to)->count() ||
            $reservations->where('from', '<', $from)->where('to', '>', $from)->count() ||
            $reservations->where('from', '<', $to)->where('to', '>', $to)->count()||
            $reservations->where('from', '<', $from)->where('to', '>', $to)->count()
        )
        {
            return true;
        }
        else{
            return false;
        }
    }
}
