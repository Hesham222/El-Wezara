<?php
namespace Organization\Actions\SupplierService;
use Illuminate\Http\Request;
use Organization\Models\{SportActivityAreas, Supplier, SupplierService};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = SupplierService::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
