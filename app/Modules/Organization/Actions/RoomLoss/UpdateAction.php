<?php
namespace Organization\Actions\RoomLoss;
use Illuminate\Http\Request;
use Organization\Models\{
    RoomLoss
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record              = RoomLoss::find($id);
        $record->room_id     = $request->input('room');
        $record->missingInfo       = $request->input('notes');
        $record->customer = $request->input('customer');
        $record->request_date      = $request->input('request_date');
        $record->save();
        return $record;
    }
}
