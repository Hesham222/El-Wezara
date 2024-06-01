<?php
namespace Organization\Actions\SupplierService;
use Illuminate\Http\Request;

use Organization\Models\{SportActivityAreas, Supplier, SupplierService};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = SupplierService::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
