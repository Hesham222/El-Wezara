<?php
namespace Organization\Actions\Vendor;
use Illuminate\Http\Request;
use Organization\Models\{
    VendorIngredient
};
class IngredientUpdateAction
{
    public function execute(Request $request,$id)
    {
        $record             = VendorIngredient::find($id);

        $record->price      = $request->input('price');
        $record->save();
        return $record;
    }
}
