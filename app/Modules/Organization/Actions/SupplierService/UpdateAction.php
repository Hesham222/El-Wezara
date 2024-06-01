<?php
namespace Organization\Actions\SupplierService;
use Illuminate\Http\Request;
use Organization\Models\{Supplier, SupplierService};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                     = SupplierService::find($id);
        $record->name               = $request->input('name');
        $record->price              = $request->input('price');
        $record->club_commission    = $request->input('commission');
        $record->description        = $request->input('description');
        $record->vendor_id       =  $request->input('supplier_selected');
        $record->save();
        return $record;
    }
}
