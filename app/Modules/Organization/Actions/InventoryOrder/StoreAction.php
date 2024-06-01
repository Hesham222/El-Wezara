<?php
namespace Organization\Actions\InventoryOrder;
use Illuminate\Http\Request;
use Organization\Models\laundry;
use Organization\Models\LaundryEmployee;
use Organization\Models\{InventoryOrder,
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
        $record =  InventoryOrder::create([
            'laundry_id'              => $request->input('laundry'),
            'status'                    => $request->input('pending'),
            'created_by'                => auth('organization_admin')->user()->id,
            'status'                    => 'pending'
        ]);

        $notification = new Notification(); 
        $notification->model_type  = 'InventoryOrder';
        $notification->model_id   = $record->id ;
        $notification->body = 'هناك طلب جديد من مغلسه  ';
        $notification->save();

        if ($request->input('ingredients')){
            $i  =   0 ;

            foreach ($request->input('ingredients') as $ingredient)
            {
                InventoryOrderIngredient::create([
                    'quantity'=>$request->input('ingredient_quantity')[$i],
                    'ingredient_id' => $ingredient,
                    'inventory_order_id' => $record->id,
                ]);
                $i++;
            }
        }


        return $record;
    }
}
