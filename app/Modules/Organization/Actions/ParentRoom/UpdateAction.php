<?php
namespace Organization\Actions\ParentRoom;
use Illuminate\Http\Request;
use Organization\Models\{
    ParentRoom
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                             = ParentRoom::find($id);
        $record->hotel_id                   = $request->input('hotel');
        //$record->quantity                   = $request->input('quantity');
        //$record->start_room_num             = $request->input('start_room_num');
        $record->child_price                = $request->input('child_price');
        $record->extra_price                = $request->input('extra_price');
        $record->save();
        return $record;
    }
}
