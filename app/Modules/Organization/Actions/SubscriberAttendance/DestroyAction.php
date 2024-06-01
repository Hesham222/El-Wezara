<?php
namespace Organization\Actions\SubscriberAttendance;
use Illuminate\Http\Request;

use Organization\Models\{
    SubscriberAttendance
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = SubscriberAttendance::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
