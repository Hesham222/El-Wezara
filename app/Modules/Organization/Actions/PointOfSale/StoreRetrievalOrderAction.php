<?php
namespace Organization\Actions\PointOfSale;
use Illuminate\Http\Request;
use Organization\Models\{AreaRetrievalOrderIngredent,
    LaundryService,
    LService,
    PointOfSaleInventory,
    PointOfSaleRetrievalOrder,
    PointOfSaleRetrievalOrderIngredent,
    PreparationArea,
    PreparationAreaCategory,
    PreparationAreaEmployee,
    PreparationAreaInventory,
    PreparationAreaRetrievalOrder,
    PreparationAreaStocking,
    PreparationAreaStockingIngredient};
class StoreRetrievalOrderAction
{
    public function execute(Request $request)
    {

        if ($request->input('type') == 'general'){

            $order =  PointOfSaleRetrievalOrder::create([
                'sender_id'                      => $request->input('point_id'),
                'type'               => $request->input('type'),
            ]);

        }else{

            $order =  PointOfSaleRetrievalOrder::create([
                'sender_id'                      => $request->input('point_id'),
                'resever_id'                      => $request->input('point'),
                'type'               => $request->input('type'),
            ]);
        }





        if ($request->has('ingredients') && $request->has('quantity_before') && $request->has('quantity_after') )
        {


            for ($i=0;$i<count($request->input('ingredients'));$i++)
            {

                $pointOfSalInventory = PointOfSaleInventory::where('PointOfSale_id',$request->input('point_id'))
                    ->where('ingredient_id',$request->input('ingredients')[$i])->first();

                if ($pointOfSalInventory){

                    if ($pointOfSalInventory->quantity < $request->input('quantity_after')[$i]){
                        return 0;
                    }elseif ($request->input('quantity_after')[$i] == 0){
                        continue;
                    }
                    PointOfSaleRetrievalOrderIngredent::create([
                        'order_id'                      => $order->id,
                        'ingredient_id'               => $request->input('ingredients')[$i],
                        'quantity'               => $request->input('quantity_after')[$i],
                    ]);

                    $pointOfSalInventory->quantity -=$request->input('quantity_after')[$i];
                    $pointOfSalInventory->save();
                }else{
                    return 0;
                }


            }


        }

        return 1;
    }
}
