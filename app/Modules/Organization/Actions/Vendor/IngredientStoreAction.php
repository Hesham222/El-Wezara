<?php
namespace Organization\Actions\Vendor;
use Illuminate\Http\Request;
use Organization\Models\VendorIngredient;


class IngredientStoreAction
{
    public function execute(Request $request)
    {

        $record =  VendorIngredient::create([

                'price'             => $request->input('price'),
                'vendor_id'         => $request->input('vendor_id'),
                'ingredient_id'     => $request->input('ingredient_id'),
        ]);

        return $record;

    }
}
