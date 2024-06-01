<?php
namespace Organization\Actions\SpendPermission;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Organization\Models\PreparationAreaOrder;

class PrepFilterAction
{
    public function execute(Request $request)
    {
        return PreparationAreaOrder::when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
            return $query->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))]);
        })->where('status','received')
        //sub query used in search field
        ->when($request->input('column') && $request->input('value'), function ($query) use ($request){
            return $query->when($request->input('column') == '_id', function ($query) use ($request){
                    return $query->where('id',  $request->input('value') );
                })
                ->when($request->input('column') == 'name', function ($query) use ($request){
                    return $query->whereHas('area',function ($q) use($request){
                        return $q->where('name', 'like', '%' . $request->input('value') . '%');

                    });
                });
        });
    }
}
