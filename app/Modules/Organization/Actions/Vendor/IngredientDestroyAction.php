<?php
namespace Organization\Actions\Vendor;
use Illuminate\Http\Request;
use Organization\Models\{
    VendorIngredient
};

class IngredientDestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = VendorIngredient::find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
