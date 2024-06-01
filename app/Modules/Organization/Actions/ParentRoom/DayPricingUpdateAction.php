<?php
namespace Organization\Actions\ParentRoom;
use Illuminate\Http\Request;
use Organization\Models\{
    RoomDayPricing
};
class DayPricingUpdateAction
{
    public function execute(Request $request,$record)
    {
        $data = $request->all();

        RoomDayPricing::where('parentRoom_id',$record->id)->forceDelete();

            for ($i=0;$i<count($data['guest_id']);$i++) {

                $schedule = new RoomDayPricing();
                $schedule->parentRoom_id        = $record->id;
                $schedule->customerType_id      = $request->guest_id[$i];
                $schedule->roomType_id          = $request->room_id[$i];
                $schedule->price                = $request->dayPrice[$i];
                $schedule->save();
            }
    }
}
