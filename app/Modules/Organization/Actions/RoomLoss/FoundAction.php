<?php
namespace Organization\Actions\RoomLoss;
use Illuminate\Http\Request;
use Organization\Models\{
    RoomLoss
};
class FoundAction
{
    public function execute(Request $request,$id)
    {
        $record              = RoomLoss::find($id);
        $record->found_date     = $request->input('found_date');
        $record->found_by = $request->input('foundBy');
        $record->save();
        return $record;
    }
}
