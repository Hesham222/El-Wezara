<?php
namespace Organization\Actions\Subscription;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Organization\Models\Subscription;

class FilterAction
{
    public function execute(Request $request)
    {
        return Subscription::when($request->input('subscriber'), function ($query) use ($request){
            return $query->where('subscriber_id',  $request->input('subscriber') );
        })->when($request->input('training'), function ($query) use ($request){
                return $query->where('training_id',  $request->input('training') );
        })->when($request->input('price_name'), function ($query) use ($request){
                return $query->where('pricing_name',  $request->input('price_name') );

        })->where('cancelled', 0)
            ->where('current_session','>',0)->orWhere('start_date','<=',Carbon::now())->orWhere('end_date','=>',Carbon::now())->when($request->input('view') == 'trash', function ($query) use ($request) {
            return $query->onlyTrashed();
        })->with(['deletedBy' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])
        ->with(['Subscriber' => function ($query) use ($request) {
                $query->select(['id','name']);
        }])
        ->with(['Training' => function ($query) use ($request) {
                $query->select(['id','name']);
        }])
        ->select(['id','subscriber_id','training_id','overpriced','current_session','price','pricing_name','session_balance','start_date','end_date','payment_balance','paid_date','deleted_by','deleted_at', 'created_at'])
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
