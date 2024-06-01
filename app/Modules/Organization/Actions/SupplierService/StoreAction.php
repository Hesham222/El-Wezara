<?php
namespace Organization\Actions\SupplierService;
use Illuminate\Http\Request;
use Organization\Models\{Supplier, SupplierService};
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  SupplierService::create([
            'name'              =>  $request->input('name'),
            'price'             =>  $request->input('price'),
            'club_commission'   =>  $request->input('commission'),
            'description'       =>  $request->input('description'),
            'vendor_id'       =>  $request->input('supplier_selected')
        ]);
        return $record;
    }
}
