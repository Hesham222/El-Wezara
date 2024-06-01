<?php
namespace Organization\Actions\TodayVisitor\Inventory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Organization\Models\PurchaseOrder;

class FilterAction
{
    public function execute(Request $request)
    {
        return PurchaseOrder::where('expected',date('Y-m-d'))
        ->when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
            return $query->whereBetween('expected',[Carbon::parse($request->input('start_date'))->subDays(1), Carbon::parse($request->input('end_date'))->subDays(-1)]);
        })
            //sub query used in search field
            ->when($request->input('column') && $request->input('value'), function ($query) use ($request){
                return $query->when($request->input('column') == '_id', function ($query) use ($request){
                    return $query->where('id',  $request->input('value') );
                })->when($request->input('column') == 'name' , function ($query) use ($request){
                    return $query->whereHas('vendor', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->input('value') . '%');
                    });
                });
            });
    }
}
