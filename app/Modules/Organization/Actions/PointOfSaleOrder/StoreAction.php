<?php
namespace Organization\Actions\PointOfSaleOrder;
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
    PointOfSaleInventory,
    PointOfSaleOrder,
    PointOfSaleOrderIngredient,
    Notification,
    Subscriber};
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  PointOfSaleOrder::create([
            'PointOfSale_id'            => $request->input('PointOfSale'),
            'status'                    => 'pending',
            'created_by'                => auth('organization_admin')->user()->id,
        ]);


        $notification = new Notification(); 
        $notification->model_type  = 'PointOfSaleOrder';
        $notification->model_id   = $record->id ;
        $notification->body = 'هناك طلب جديد من نقطه  بيع';
        $notification->save();



        if ($request->input('ingredients')){
            $i  =   0 ;

            foreach ($request->input('ingredients') as $ingredient)
            {
                PointOfSaleOrderIngredient::create([
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
