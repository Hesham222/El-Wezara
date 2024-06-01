<?php
namespace Organization\Actions\PointOfSale;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Organization\Models\PointOfSale;
use Organization\Models\PreparationArea;

class FilterAction
{
    public function execute(Request $request)
    {
        return PointOfSale::when($request->input('view') == 'trash', function ($query) use ($request) {
            return $query->onlyTrashed();
        })
        ->select(['id','name','manager_id','created_at'])
        ->when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
            return $query->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))]);
        })
        //sub query used in search field
        ->when($request->input('column') && $request->input('value'), function ($query) use ($request){
            return $query
                ->when($request->input('column') == '_id', function ($query) use ($request){
                    return $query->where('id',  $request->input('value') );
                })
                ->when($request->input('column') == 'name', function ($query) use ($request){
                    return $query->where('name', 'like', '%' . $request->input('value') . '%');
                });
        });

    }
}
