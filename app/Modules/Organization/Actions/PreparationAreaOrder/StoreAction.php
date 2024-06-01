<?php
namespace Organization\Actions\PreparationAreaOrder;
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
    PreparationAreaOrder,
    PreparationAreaOrderIngredient,
    Notification,
    Subscriber};
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  PreparationAreaOrder::create([
            'area_id'                   => $request->input('area'),
            'status'                    => 'pending',
            'created_by'                => auth('organization_admin')->user()->id,
        ]);

        $notification = new Notification(); 
$notification->model_type  = 'PreparationAreaOrder';
$notification->model_id   = $record->id ;
$notification->body = 'هناك طلب جديد من منطقة  تحضير';
$notification->save();

        if ($request->input('ingredients')){
            $i  =   0 ;

            foreach ($request->input('ingredients') as $ingredient)
            {
                PreparationAreaOrderIngredient::create([
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
