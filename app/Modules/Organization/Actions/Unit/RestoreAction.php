<?php
namespace Organization\Actions\Unit;;
use Illuminate\Http\Request;
use Organization\Models\{
    UnitMeasurement
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = UnitMeasurement::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
