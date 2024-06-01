<?php
namespace Organization\Actions\TodayVisitor\Rent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Organization\Models\RentContract;

class FilterAction
{
    public function execute(Request $request)
    {
        return RentContract::where([ ['start_date','<=',date('Y-m-d')],['end_date','>=',date('Y-m-d')] ])
        ->when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
            return $query->whereBetween('start_date',[Carbon::parse($request->input('start_date'))->subDays(1), Carbon::parse($request->input('end_date'))->subDays(-1)])
                ->orwhereBetween('end_date',[Carbon::parse($request->input('start_date'))->subDays(1), Carbon::parse($request->input('end_date'))->subDays(-1)]);
        })
            //sub query used in search field
            ->when($request->input('column') && $request->input('value'), function ($query) use ($request){
                return $query->when($request->input('column') == '_id', function ($query) use ($request){
                    return $query->where('id',  $request->input('value') );
                })->when($request->input('column') == 'name' , function ($query) use ($request){
                    return $query->whereHas('tenant', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->input('value') . '%');
                    });
                });
            });
    }
}
