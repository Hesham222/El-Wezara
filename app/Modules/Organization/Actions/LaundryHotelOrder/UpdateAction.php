<?php
namespace Organization\Actions\LaundryHotelOrder;
use Illuminate\Http\Request;
use Organization\Models\{
    LaundryHotelOrder,
    LaundryHotelOrderService,
};

class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                             = LaundryHotelOrder::find($id);
        $record->customer_name              = $request->input('name');
        $record->customer_mobile            = $request->input('mobile');
        $record->laundry_id                 = $request->input('laundry_id');
        $record->room_id                    = $request->input('rooms');
        $record->hotel_id                   = $request->input('hotels');
        $record->time                       = $request->input('time');
        $record->date                       = $request->input('date');
        $record->total_price                = $request->input('total_price');
        $record->save();




        if ($request->input('services')){
            $i  =   0 ;
            $record->laundryOrderServices()->delete();
            foreach ($request->input('services') as $service_id)
            {
                LaundryHotelOrderService::create([
                    'quantity'=>$request->input('category_quantity')[$i],
                    'price'=>$request->input('category_price')[$i],
                    'laundry_hotel_order_id'    =>  $record->id,
                    'laundry_category_id'       =>  $request->input('categories')[$i],
                    'laundry_sub_category_id'   =>  $request->input('subCategories')[$i],
                    'laundry_service_id'        =>  $service_id,
                ]);
                $i++;
            }
        }

        return $record;
    }
}
