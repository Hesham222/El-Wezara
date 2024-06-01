<?php
namespace Organization\Actions\SupplierService;
use Illuminate\Http\Request;
use Organization\Models\{SportActivityAreas, Supplier, SupplierService};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = SupplierService::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
