<?php
namespace Organization\Actions\RoomMaintenanceRequest;;
use Illuminate\Http\Request;
use Organization\Models\{
    RoomMaintenanceRequest
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = RoomMaintenanceRequest::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
