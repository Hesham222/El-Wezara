<?php
namespace Organization\Actions\PreparationArea;
use Illuminate\Http\Request;
use Organization\Models\{AreaRetrievalOrderIngredent,
    LaundryService,
    LService,
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

            $order =  PreparationAreaRetrievalOrder::create([
                'sender_id'                      => $request->input('area_id'),
                'type'               => $request->input('type'),
            ]);

        }else{

            $order =  PreparationAreaRetrievalOrder::create([
                'sender_id'                      => $request->input('area_id'),
                'resever_id'                      => $request->input('area'),
                'type'               => $request->input('type'),
            ]);
        }





        if ($request->has('ingredients') && $request->has('quantity_before') && $request->has('quantity_after') )
        {


            for ($i=0;$i<count($request->input('ingredients'));$i++)
            {

                $prepAreaInventory = PreparationAreaInventory::where('area_id',$request->input('area_id'))
                    ->where('ingredient_id',$request->input('ingredients')[$i])->first();

                if ($prepAreaInventory){

                    if ($prepAreaInventory->quantity < $request->input('quantity_after')[$i]){
                        return 0;
                    }elseif ($request->input('quantity_after')[$i] == 0){
                        continue;
                    }
                    AreaRetrievalOrderIngredent::create([
                        'order_id'                      => $order->id,
                        'ingredient_id'               => $request->input('ingredients')[$i],
                        'quantity'               => $request->input('quantity_after')[$i],
                    ]);

                    $prepAreaInventory->quantity -=$request->input('quantity_after')[$i];
                    $prepAreaInventory->save();
                }else{
                    return 0;
                }


            }


        }

        return 1;
    }
}
