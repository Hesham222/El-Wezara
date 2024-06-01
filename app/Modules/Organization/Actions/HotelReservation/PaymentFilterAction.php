<?php
namespace Organization\Actions\HotelReservation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Organization\Models\HotelReservationPayment;

class PaymentFilterAction
{
    public function execute(Request $request)
    {
        return HotelReservationPayment::when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
                return $query->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))]);
            })
            //sub query used in search field
            ->when($request->input('column') && $request->input('value'), function ($query) use ($request){
                return $query->when($request->input('column') == 'room' , function ($query) use ($request){
                    return $query->whereHas('reservation', function ($query) use ($request) {
                        $query->where('room_id', $request->input('value'));
                    });
                })
                    ->when($request->input('column') == '_id', function ($query) use ($request){
                        return $query->where('id',  $request->input('value') );
                    });
            });

    }
}
