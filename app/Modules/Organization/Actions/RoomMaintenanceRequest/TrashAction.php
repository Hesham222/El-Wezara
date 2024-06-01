<?php
namespace Organization\Actions\RoomMaintenanceRequest;
use Illuminate\Http\Request;
use Organization\Models\{
    RoomMaintenanceRequest
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = RoomMaintenanceRequest::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
