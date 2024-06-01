<?php
namespace Organization\Actions\HotelOrder;
use Illuminate\Http\Request;
use Organization\Models\laundry;
use Organization\Models\LaundryEmployee;
use Organization\Models\{HotelOrder,
    HotelOrderIngredient,
    InventoryOrder,
    InventoryOrderIngredient,
    laundryOrder,
    LaundryOrderService,
    LaundryOrderSubCategory,
    LService,
    LaundrySubCategoryService,
    Notification,
    Subscriber};
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  HotelOrder::create([
            'hotel_id'              => $request->input('hotel'),
            'status'                    => $request->input('pending'),
            'created_by'                => auth('organization_admin')->user()->id,
            'status'                    => 'pending'
        ]);

        $notification = new Notification(); 
        $notification->model_type  = 'HotelOrder';
        $notification->model_id   = $record->id ;
        $notification->body = 'هناك طلب جديد من فندق  ';
        $notification->save();


        if ($request->input('ingredients')){
            $i  =   0 ;

            foreach ($request->input('ingredients') as $ingredient)
            {
                HotelOrderIngredient::create([
                    'quantity'=>$request->input('ingredient_quantity')[$i],
                    'ingredient_id' => $ingredient,
                    'hotel_order_id' => $record->id,
                ]);
                $i++;
            }
        }


        return $record;
    }
}
