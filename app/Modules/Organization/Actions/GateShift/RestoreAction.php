<?php
namespace Organization\Actions\GateShift;;
use Illuminate\Http\Request;
use Organization\Models\{
    GateShift
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = GateShift::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
