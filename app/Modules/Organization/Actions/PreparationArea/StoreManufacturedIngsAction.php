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
class StoreManufacturedIngsAction
{
    public function execute(Request $request)
    {

        $inventory = PreparationAreaInventory::FindOrFail($request->inventory);

        if ($inventory->quantity < $request->manufactured ){
            return 0;
        }

        if ($request->has('ingredients'))
        {


            for ($i=0;$i<count($request->input('ingredients'));$i++)
            {

                if ($request->input('manufacturedQuantity')[$i] == "" || $request->input('manufacturedQuantity')[$i] == null|| $request->input('manufacturedQuantity')[$i] == 0 )
                        continue;


                $ing_exsists = PreparationAreaInventory::
                    where('area_id',$inventory->area_id)->where('ingredient_id',$request->input('ingredients')[$i])
                    ->first();

                if (!$ing_exsists)
                {


                    PreparationAreaInventory::create([
                        'area_id'                      => $inventory->area_id,
                        'ingredient_id'               => $request->input('ingredients')[$i],
                        'quantity'               => $request->input('manufacturedQuantity')[$i],
                        'manufacturedQuantity'               => $request->input('manufacturedQuantity')[$i],
                        'calc_cost'               => $request->input('calc_cost')[$i],
                        'financial_value'               => $request->input('financial_value')[$i],
                        'final_cost'               => $request->input('final_cost')[$i],
                    ]);



                }
                else
                {

                    $ing_exsists->quantity+=$request->input('manufacturedQuantity')[$i];
                    $ing_exsists->manufacturedQuantity+=$request->input('manufacturedQuantity')[$i];
                    $ing_exsists->calc_cost =$request->input('calc_cost')[$i];
                    $ing_exsists->financial_value =$request->input('financial_value')[$i];
                    $ing_exsists->final_cost =$request->input('final_cost')[$i];
                    $ing_exsists->save();
                }




            }


        }

        $inventory->quantity = $inventory->quantity - $request->manufactured ;
        $inventory->save();
        return $inventory->area_id;
    }
}
