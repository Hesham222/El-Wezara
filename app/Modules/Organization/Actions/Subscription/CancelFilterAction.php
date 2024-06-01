<?php
namespace Organization\Actions\Subscription;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Organization\Models\Subscription;

class CancelFilterAction
{
    public function execute(Request $request)
    {
        return Subscription::select(['id','subscriber_id','training_id','overpriced','current_session','price','pricing_name','session_balance','start_date','end_date','payment_balance','paid_date','deleted_by','attendance','cancelled','reason_of_cancelled','attendance_price','commission','rest_of_paid','amount_after_discount','cancelled_at','cancelled_by','deleted_at', 'created_at'])

            ->when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
            return $query->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))]);
        })->where('cancelled',1)
        //sub query used in search field
        ->when($request->input('column') && $request->input('value'), function ($query) use ($request){
            return $query->when($request->input('column') == 'createdBy', function ($query) use ($request) {
                return $query->whereHas('createdBy', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->input('value') . '%');
                    });
                })
                ->when($request->input('column') == 'deletedBy' , function ($query) use ($request){
                    return $query->whereHas('deletedBy', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->input('value') . '%');
                    });
                })
                ->when($request->input('column') == '_id', function ($query) use ($request){
                    return $query->where('id',  $request->input('value') );
                })
                ->when($request->input('column') == 'name', function ($query) use ($request){
                    return $query->where('name', 'like', '%' . $request->input('value') . '%');


                });
        });

    }
}
