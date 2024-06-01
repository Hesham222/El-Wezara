<?php
namespace Organization\Actions\ParentRoom;
use Illuminate\Http\Request;
use Organization\Models\{
    ParentRoom
};
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  ParentRoom::create([
            'hotel_id'                  => $request->input('hotel'),
            'quantity'                  => $request->input('quantity'),
            'start_room_num'            => $request->input('start_room_num'),
            'child_price'               => $request->input('child_price'),
            'extra_price'               => $request->input('extra_price'),
        ]);
        return $record;
    }
}
