<?php
namespace Organization\Actions\PointOfSale;
use Illuminate\Http\Request;
use Organization\Models\{LService, PointOfSale};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = PointOfSale::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
