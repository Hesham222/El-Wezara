<?php
namespace Organization\Actions\ParentRoom;
use Illuminate\Http\Request;
use Organization\Models\{
    RoomDayPricing
};
class DayPricingStoreAction
{
    public function execute(Request $request,$record)
    {

        $data = $request->all();

        foreach ($data['guest_id'] as $key => $value) {

            if(!empty($value)){

                $schedule = new RoomDayPricing();
                $schedule->parentRoom_id        = $record->id;
                $schedule->customerType_id      = $data['guest_id'][$key];
                $schedule->roomType_id          = $data['room_id'][$key];
                $schedule->price                = $data['dayPrice'][$key];
                $schedule->save();
            }
        }



    }
}
