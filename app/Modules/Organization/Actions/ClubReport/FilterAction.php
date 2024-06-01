<?php
namespace Organization\Actions\ClubReport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Organization\Models\Schedule;
use Organization\Models\Training;

class FilterAction
{
    public function execute(Request $request)
    {
        return Schedule::where('day',$request->input('day'))
         ->when($request->input('day'), function ($query) use ($request){
            return $query->where('day',  $request->input('day') );

        })->with('Training')
        ->select(['id','training_id','day','start_time','end_time','created_at'])
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
        })->whereHas('Training',function ($query) use ($request){
                $query->whereHas('Subscriptions',function ($q) use ($request){
                    $q->where('cancelled', 0)->where('current_session','>',0)->orWhere('start_date','<=',Carbon::now())->orWhere('end_date','=>',Carbon::now());
                });
            });

    }
}
