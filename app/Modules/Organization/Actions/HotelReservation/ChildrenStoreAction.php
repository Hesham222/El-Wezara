<?php
namespace Organization\Actions\HotelReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Organization\Models\{
    LinkedChildren
};
class ChildrenStoreAction
{
    public function execute(Request $request,$record)
    {
        $data = $request->all();
        $children = $record->num_of_children;

        for ($i=0;$i<$children;$i++) {

            if (isset($request->children_name[$i])) {
                $schedule = new LinkedChildren();
                $schedule->hotel_reservation_id     = $record->id;
                $schedule->name                     = $request->children_name[$i];
                $schedule->age                      = $request->age[$i];
                $schedule->save();
            }else{
                return redirect()->route('organizations.hotelReservation.create')->with('error','يجب أن تسجل عدد بيانات الاطفال بشكل صحيح مراعيا عدد الاطفال اللذي قمت بادخاله .');
            }
        }
    }
}
