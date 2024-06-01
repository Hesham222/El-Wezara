<?php
namespace Organization\Actions\TrainerAttendance;
use Illuminate\Http\Request;

use Organization\Models\{
    TrainerAttendance
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = TrainerAttendance::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
