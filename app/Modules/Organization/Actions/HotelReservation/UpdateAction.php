<?php
namespace Organization\Actions\HotelReservation;
use Illuminate\Http\Request;
use Organization\Models\{
    HotelReservation
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                                 = HotelReservation::find($id);
        $record->customer_id                    = $request->input('customer_id');
        $record->hotel_id                       = $request->input('hotel');
        $record->roomType_id                    = $request->input('roomType_id');
        $record->arrival_date                   = $request->input('arrival_date');
        $record->departure_date                 = $request->input('departure_date');
        $record->num_of_nights                  = $request->input('num_of_nights');
        $record->room_id                        = $request->input('room_id');
        $record->price_per_night	            = $request->input('price_per_night');
        $record->total_price_for_duration       = $request->input('total_price_for_duration');
        $record->num_of_children                = $request->input('num_of_children');
        $record->num_of_extra_beds              = $request->input('num_of_extra_beds');
        $record->final_price                    = $request->input('final_price');
        $record->supplier_id                    = $request->input('supplier');
        $record->save();
        return $record;
    }
}
