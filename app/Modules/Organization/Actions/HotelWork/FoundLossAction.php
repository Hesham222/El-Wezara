<?php
namespace Organization\Actions\HotelWork;
use Illuminate\Http\Request;
use Organization\Models\RoomHouseKeeping;
use Carbon\Carbon;
use Organization\Models\HotelReservation;
use Organization\Models\RoomLoss;

class FoundLossAction
{
    
    
    
    public function execute(Request $request)
    {
        return RoomLoss::
        when(( ($request->input('start_date') && $request->input('start_date') <= date('Y-m-d'))), function ($query) use ($request) {
            return $query->whereBetween('found_date',[Carbon::parse($request->input('found_date')), Carbon::parse($request->input('end_date'))]);
        });
     

    }
}