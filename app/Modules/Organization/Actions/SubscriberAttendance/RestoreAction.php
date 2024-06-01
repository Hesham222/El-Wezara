<?php
namespace Organization\Actions\SubscriberAttendance;
use Illuminate\Http\Request;
use Organization\Models\SubscriberAttendance;
use Organization\Models\{
    TrainerAttendance
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = SubscriberAttendance::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
