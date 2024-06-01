<?php
namespace Organization\Actions\PreparationArea;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Organization\Models\OrderItem;
use Organization\Models\PreparationArea;

class FilterOrderItemsAction
{
    public function execute(Request $request,$id)
    {
        return OrderItem::with(['order','ingredent','item','item_variant'])
            ->where('preparation_area_id',$id)
            ->where('status','preparing')
            ->whereIn('component_type',['Item','Item Variant'])
            ->when($request->input('view') == 'trash', function ($query) use ($request) {
            return $query->onlyTrashed();
        })

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
                   return  $query->whereHas('item',function ($q) use ($request){
                        return $q->where('name->en', 'like', '%' . $request->input('value') . '%')
                            ->orWhere('name->ar', 'like', '%' . $request->input('value') . '%');

                    })
                       ->orWhereHas('item_variant',function ($q) use ($request){
                           return $q->where('name->en', 'like', '%' . $request->input('value') . '%')
                               ->orWhere('name->ar', 'like', '%' . $request->input('value') . '%');

                       });
                    });
            });

    }
}
