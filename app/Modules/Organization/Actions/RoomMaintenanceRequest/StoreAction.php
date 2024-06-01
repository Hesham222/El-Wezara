<?php
namespace Organization\Actions\RoomMaintenanceRequest;
use Illuminate\Http\Request;
use Organization\Models\Rooms;
use Organization\Models\{
    RoomMaintenanceRequest
};
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  RoomMaintenanceRequest::create([
            'room_id'       => $request->input('room'),
            'notes'         => $request->input('notes'),
            'status'        => "Pending",
            'employee_id'   => $request->input('employee'),
            'created_by' => auth('organization_admin')->user()->id,
        ]);
        Rooms::where('id',$record->room_id)->update([
            'status' => 'UnAvailable',
        ]);
        return $record;
    }
}
