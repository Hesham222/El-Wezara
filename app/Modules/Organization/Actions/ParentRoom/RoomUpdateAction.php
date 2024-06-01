<?php
namespace Organization\Actions\ParentRoom;
use Illuminate\Http\Request;
use Organization\Models\Rooms;
use Organization\Models\{
    RoomPricing
};
class RoomUpdateAction
{
    public function execute(Request $request,$record)
    {

        /*Rooms::where('parentRoom_id',$record->id)->forceDelete();

        for ($i=0;$i<$record->quantity;$i++) {

            $room = new Rooms();
            $room->parentRoom_id        = $record->id;
            $room->room_num             = $record->start_room_num ++;
            $room->save();
        }*/
    }
}
