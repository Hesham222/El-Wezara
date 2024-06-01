<?php
namespace Organization\Actions\Report;
use Illuminate\Http\Request;
use Organization\Models\EventType;
use Carbon\Carbon;
use Organization\Models\Package;
use Organization\Models\Reservation;

class FilterAction
{
    public function execute(Request $request)
    {
        return Reservation::when($request->input('view') == 'trash', function ($query) use ($request) {
            return $query->onlyTrashed();
        })
            ->select(['id','contact_title','contact_name','contact_email','contact_phone','contact_address','contact_national_id','booking_date','package_id','event_type_id','from','to','actual_price','paid_amount','remaining_amount','payment_due_date','status','deleted_by','deleted_at', 'created_at'])
//        ->when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
//            return $query->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))]);
//        })
            ->when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
                return $query->whereBetween('booking_date',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))]);
            })
        //sub query used in search field
        ->when($request->input('column') && $request->input('value'), function ($query) use ($request){
            return $query->
                when($request->input('column') == '_id', function ($query) use ($request){
                    return $query->where('id',  $request->input('value') );
                });
        });

    }
}
