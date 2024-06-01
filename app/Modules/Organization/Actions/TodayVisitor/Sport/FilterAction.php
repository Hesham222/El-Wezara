<?php
namespace Organization\Actions\TodayVisitor\Sport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Organization\Models\Schedule;

class FilterAction
{
    public function execute(Request $request)
    {
        $today = Carbon::parse('2022-08-14')->format('l');
        return Schedule::where('day',$today)
        ->when($request->input('day'), function ($query) use ($request){
            return $query->where('day',  $request->input('day') );

        })->with('Training')
            ->select(['id','training_id','day','start_time','end_time','created_at'])
            ->when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
                return $query->whereBetween('created_at',[Carbon::parse($request->input('start_date'))->subDays(1), Carbon::parse($request->input('end_date'))->subDays(-1)]);
            })
            //sub query used in search field
            ->when($request->input('column') && $request->input('value'), function ($query) use ($request){
                return $query->when($request->input('column') == '_id', function ($query) use ($request){
                        return $query->where('id',  $request->input('value') );
                    })
                    ->when($request->input('column') == 'name', function ($query) use ($request){
                        return $query->where('name', 'like', '%' . $request->input('value') . '%');
                    });
            });
    }
}
