<?php
namespace Organization\Actions\Item;
use Organization\Models\Ingredient;
use Organization\Models\Item;
use Organization\Models\ItemDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;
class FilterAction
{
    public function execute(Request $request)
    {
        $deleted_ingendent = Ingredient::onlyTrashed()->pluck('id');
        $item_ids = ItemDetail::whereIn('component_id',$deleted_ingendent)->pluck('item_id');


        return Item::whereNotIn('id',$item_ids)->
        when($request->input('view') == 'trash', function ($query) use ($request) {
            return $query->onlyTrashed();
        })->with(['deletedBy' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])
        ->select(['id','name', 'description','image','type',
            'cost','price',
            'deleted_by', 'created_at','deleted_at'])
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
                  ->when($request->input('column') == 'name', function ($query) use ($request){
                      return $query->where('name->en', 'like', '%' . $request->input('value') . '%')->orWhere('name->ar', 'like', '%' . $request->input('value') . '%');
                  })
                  ->when($request->input('column') == 'description', function ($query) use ($request){
                      return $query->where('description->en', 'like', '%' . $request->input('value') . '%')->orWhere('description->ar', 'like', '%' . $request->input('value') . '%');
                  })
                ->when($request->input('column') == '_id', function ($query) use ($request){
                    return $query->where('id',  $request->input('value') );
                });
        })
            ->when($request->input('column') == 'type', function ($query) use ($request){
                return $query->where('type', 'like', '%' . $request->input('value') . '%');
            })
            ->when($request->input('column') == 'cost', function ($query) use ($request){
                return $query->where('cost', 'like', '%' . $request->input('value') . '%');
            });


    }
}
