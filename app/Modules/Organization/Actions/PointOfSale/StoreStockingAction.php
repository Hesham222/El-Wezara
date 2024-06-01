<?php
namespace Organization\Actions\PointOfSale;
use Illuminate\Http\Request;
use Organization\Models\{
    LaundryService,
    LService,
    PreparationArea,
    PreparationAreaCategory,
    PreparationAreaEmployee,
    PoStoking,
    PoStokingIngredient
};

class StoreStockingAction
{
    public function execute(Request $request)
    {

        $stocking =  PoStoking::create([
            'organization_admin_id'             => auth('organization_admin')->user()->id,
            'po_id'                             => $request->input('area_id'),
        ]);


        if ($request->has('ingredients') && $request->has('quantity_before') && $request->has('quantity_after') )
        {


            for ($i=0;$i<count($request->input('ingredients'));$i++)
            {

                PoStokingIngredient::create([
                    'stocking_id'                 => $stocking->id,
                    'ingredient_id'               => $request->input('ingredients')[$i],
                    'quantity_before'             => $request->input('quantity_before')[$i],
                    'quantity_after'              => $request->input('quantity_after')[$i],
                ]);

            }


        }

    }
}
