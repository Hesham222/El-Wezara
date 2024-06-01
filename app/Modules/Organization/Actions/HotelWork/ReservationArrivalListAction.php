<?php
namespace Organization\Actions\HotelWork;
use Illuminate\Http\Request;
use Organization\Models\RoomHouseKeeping;
use Carbon\Carbon;
use Organization\Models\HotelReservation;

class ReservationArrivalListAction
{
    
    
    public function execute(Request $request)
    {
        return HotelReservation::
        when(( ($request->input('start_date') && $request->input('start_date') <= date('Y-m-d'))), function ($query) use ($request) {
            return $query->whereBetween('arrival_date',[Carbon::parse($request->input('arrival_date')), Carbon::parse($request->input('end_date'))]);
        });
     

    }
}