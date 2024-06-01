<?php
namespace Organization\Actions\PaymentReport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Organization\Models\Payment;
use Organization\Models\Schedule;

class FilterAction
{
    public function execute(Request $request)
    {
        return Payment::when($request->input('subscriber'), function ($query) use ($request){
            return $query->where('subscriber_id',  $request->input('subscriber') );

        }) ->when($request->input('subscription'), function ($query) use ($request){
            return $query->where('subscription_id',  $request->input('subscription') );

        }) ->when($request->input('training'), function ($query) use ($request){
            return $query->whereHas('Subscription',function ($que) use ($request){
                $que->where('training_id',  $request->input('training') );
            });

        }) ->when($request->input('phone'), function ($query) use ($request){
            return $query->whereHas('Subscriber',function ($que) use ($request){
                $que->where('phone',  $request->input('phone') );
            });
        }) ->when($request->input('payment'), function ($query) use ($request){
            $query->where('id',  $request->input('payment') );
        })->whereBetween('created_at', [$request->input('date_from'), $request->input('date_to')])
        ->  when($request->input('view') == 'trash', function ($query) use ($request) {
            return $query->onlyTrashed();
        })->with(['deletedBy' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])
            ->with(['Subscriber' => function ($query) use ($request) {
                $query->select(['id','name','phone']);
            }])
            ->with('Subscription')
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
