<?php
namespace Organization\Actions\Supplier;
use Illuminate\Http\Request;
use Organization\Models\{SportActivityAreas, Supplier};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Supplier::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
