<?php
namespace Organization\Actions\Payment;
use Illuminate\Http\Request;
use Organization\Models\Payment;
use Carbon\Carbon;
class FilterAction
{
    public function execute(Request $request)
    {
        return Payment::when($request->input('subscriber'), function ($query) use ($request){
            return $query->where('subscriber_id',  $request->input('subscriber') );
        })->when($request->input('price_name'), function ($query) use ($request){
            return $query->whereHas('Subscription',function ($query) use ($request){
                $query->where('pricing_name',  $request->input('price_name') );
            } );
        })->  when($request->input('view') == 'trash', function ($query) use ($request) {
            return $query->onlyTrashed();
        })->with(['deletedBy' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])
        ->with(['Subscriber' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])
        ->with(['Subscription' => function ($query) use ($request) {
            $query->select(['id','pricing_name']);
        }])
        ->select(['id','subscriber_id','subscription_id','payment_balance','approved','payment_amount','payment_method','deleted_by','deleted_at', 'created_at'])
        ->when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
            return $query->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))]);
        })
        //sub query used in search field
        ->when($request->input('column') && $request->input('value'), function ($query) use ($request){
            return $query->when($request->input('column') == 'deletedBy' , function ($query) use ($request){
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
