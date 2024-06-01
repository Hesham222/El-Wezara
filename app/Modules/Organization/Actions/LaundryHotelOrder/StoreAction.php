<?php
namespace Organization\Actions\LaundryHotelOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Organization\Models\{LaundryHotelOrder,
    LaundryHotelOrderService,
    LaundryOrder,
    LaundryOrderService,
    LaundryOrderSubCategory,
    LService,
    LaundrySubCategoryService,
    Subscriber};
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  LaundryHotelOrder::create([
            'laundry_id'            => $request->input('laundry_id'),
            'room_id'               => $request->input('rooms'),
            'hotel_id'              => $request->input('hotels'),
            'customer_name'         => $request->input('name'),
            'customer_mobile'       => $request->input('mobile'),
            'total_price'           => $request->input('total_price'),
            'date'                  => Carbon::now()->toDateString(),
            'time'                  => Carbon::now()->toTimeString(),
        ]);



        if ($request->input('services')){
            $i  =   0 ;
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
