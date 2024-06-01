<?php
namespace Organization\Actions\HotelReservation;
use Illuminate\Http\Request;
use Organization\Models\{
    LinkedChildren
};
class ChildrenUpdateAction
{
    public function execute(Request $request,$record)
    {

        $data = $request->all();
        if (isset($data['children_name']))
        {
            LinkedChildren::where('hotel_reservation_id',$record->id)->forceDelete();

            for ($i=0;$i<count($data['children_name']);$i++) {

                $schedule = new LinkedChildren();
                $schedule->hotel_reservation_id     = $record->id;
                $schedule->name                     = $request->children_name[$i];
                $schedule->age                      = $request->age[$i];
                $schedule->save();
            }
        }
    }
}
