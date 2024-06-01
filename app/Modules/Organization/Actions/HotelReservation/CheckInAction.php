<?php

namespace Organization\Actions\HotelReservation;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Organization\Models\HotelReservation;
use Organization\Models\RoomHouseKeeping;
use Organization\Models\Rooms;

class CheckInAction
{
    public function execute(Request $request)
    {
        $reservation = HotelReservation::find($request->resource_id);
        if ($reservation->checkIn == 1)
            return null;

        $date = $reservation->arrival_date;
        for ($i = 0; $i <= $reservation->num_of_nights; $i++)
        {
            if ($i > 0)
                $date = Carbon::parse($date)->addDays(1);

            RoomHouseKeeping::create([
                'room_id'   =>  $reservation->room_id,
                'occupied_date' => $date,
                'status'    => "Pending"
            ]);
        }
        $reservation->checkIn = 1;
        $reservation->save();
        Rooms::where('id',$reservation->room_id)->update([
            'status' => "Occupied"
        ]);
        return $reservation;
    }
}
