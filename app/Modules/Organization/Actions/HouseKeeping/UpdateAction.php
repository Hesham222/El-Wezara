<?php
namespace Organization\Actions\HouseKeeping;
use Illuminate\Http\Request;
use Organization\Models\{
    RoomHouseKeeping
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record              = RoomHouseKeeping::find($id);
        $record->status      = $request->input('status');
        $record->num_persons = $request->input('persons');
        $record->save();
        return $record;
    }
}
