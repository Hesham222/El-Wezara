<?php
namespace Organization\Actions\RoomMaintenanceRequest;
use Illuminate\Http\Request;
use Organization\Models\{
    RoomMaintenanceRequest
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record              = RoomMaintenanceRequest::find($id);
        $record->room_id     = $request->input('room');
        $record->notes       = $request->input('notes');
        $record->employee_id = $request->input('employee');
        $record->status      = $request->input('status');
        $record->save();
        return $record;
    }
}
