<?php
namespace Organization\Actions\ParentRoom;
use Illuminate\Http\Request;
use Organization\Models\{
    RoomPricing
};
class PricingStoreAction
{
    public function execute(Request $request,$record)
    {
        $data = $request->all();

        foreach ($data['guestType_id'] as $key => $value) {

            if(!empty($value)){

                $schedule = new RoomPricing();
                $schedule->parentRoom_id        = $record->id;
                $schedule->customerType_id      = $data['guestType_id'][$key];
                $schedule->roomType_id          = $data['roomType_id'][$key];
                $schedule->price                = $data['price'][$key];
                $schedule->save();
            }
        }
    }
}
