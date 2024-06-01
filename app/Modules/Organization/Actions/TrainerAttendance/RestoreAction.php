<?php
namespace Organization\Actions\TrainerAttendance;
use Illuminate\Http\Request;
use Organization\Models\{
    TrainerAttendance
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = TrainerAttendance::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
