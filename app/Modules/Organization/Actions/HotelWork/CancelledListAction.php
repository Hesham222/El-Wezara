<?php
namespace Organization\Actions\HotelWork;
use Illuminate\Http\Request;
use Organization\Models\RoomHouseKeeping;
use Carbon\Carbon;
use Organization\Models\HotelReservation;

class CancelledListAction
{



    public function execute(Request $request)
    {
        return HotelReservation::where('checkIn',0)->
        when(( ($request->input('start_date') && $request->input('start_date') <= date('Y-m-d'))), function ($query) use ($request) {
            return $query->whereBetween('created_at',[Carbon::parse($request->input('created_at')), Carbon::parse($request->input('end_date'))]);
        });


    }
}
