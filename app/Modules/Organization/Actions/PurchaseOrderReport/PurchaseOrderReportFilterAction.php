<?php
namespace Organization\Actions\PurchaseOrderReport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Organization\Models\PurchaseOrder;

class PurchaseOrderReportFilterAction
{
    public function execute(Request $request)
    {
        return PurchaseOrder::when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
            return $query->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))]);
        })->with('items')
        //sub query used in search field
        ->when($request->input('column') && $request->input('value'), function ($query) use ($request){
            return $query->when($request->input('column') == '_id', function ($query) use ($request){
                    return $query->where('id',  $request->input('value') );
            })
                ->when($request->input('column') == 'ingredient', function ($query) use ($request){
                     $query->whereHas('items',function ($q) use($request){
                         $q->whereHas('item',function ($qq) use($request){
                        return $qq->where('name->ar', 'like', '%' . $request->input('value') . '%');
                    });
                });
            });
        });
    }
}
