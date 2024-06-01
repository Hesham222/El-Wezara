<?php
namespace Organization\Actions\Report;
use Illuminate\Http\Request;
use Organization\Models\EventType;
use Carbon\Carbon;
use Organization\Models\Package;
use Organization\Models\Reservation;
use Organization\Models\ReservationPayment;

class FilterAction_triple
{
    public function execute(Request $request)
    {
        return Reservation::when($request->input('view') == 'trash', function ($query) use ($request) {
            return $query->onlyTrashed();
        })
            ->select(['id','contact_title','contact_name','contact_phone','booking_date','package_id','actual_price','paid_amount','event_type_id','created_at'])
            ->when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
                return $query->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))]);
            })
            ->when($request->input('column') && $request->input('value'), function ($query) use ($request){
                return $query->
                when($request->input('column') == '_id', function ($query) use ($request){
                    return $query->where('id',  $request->input('value') );
                })
                ->when($request->input('column') == 'event', function ($query) use ($request){
                    return $query->where('id',  $request->input('value') );
                });
            });

    }
}
