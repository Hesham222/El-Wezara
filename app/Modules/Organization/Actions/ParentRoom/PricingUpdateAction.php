<?php
namespace Organization\Actions\ParentRoom;
use Illuminate\Http\Request;
use Organization\Models\{
    RoomPricing
};
class PricingUpdateAction
{
    public function execute(Request $request,$record)
    {

        $data = $request->all();

        RoomPricing::where('parentRoom_id',$record->id)->forceDelete();

        for ($i=0;$i<count($data['guestType_id']);$i++) {

            $schedule = new RoomPricing();
            $schedule->parentRoom_id            = $record->id;
            $schedule->customerType_id          = $request->guestType_id[$i];
            $schedule->roomType_id              = $request->roomType_id[$i];
            $schedule->price                    = $request->price[$i];
            $schedule->save();
        }
    }
}
