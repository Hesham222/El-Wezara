<?php
namespace Organization\Actions\Ingredient;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Organization\Models\Ingredient;

class FilterReOrderAction
{
    public function execute(Request $request)
    {

        if ($request->has('searchKey')){

            return Ingredient::
            where('main',1)->
            where('re_order_quantity','>','stock')->
            select(['id','name','re_order_quantity','description','quantity','stock','re_order_quantity','final_cost','cost','price','unit_measurement_id','deleted_by','created_at'])
                ->when($request->input('searchKey') , function ($query) use ($request){

                    return $query->where('name->en', 'like', '%' . $request->input('searchKey') . '%')->orWhere('name->ar', 'like', '%' . $request->input('searchKey') . '%');
                });
        }




        return Ingredient::
        where('main',1)->
        where('re_order_quantity','>','stock')->
        when($request->input('view') == 'trash', function ($query) use ($request) {
            return $query->onlyTrashed();
        })->with(['deletedBy' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])

            ->select(['id','name', 'description','re_order_quantity','quantity','stock','final_cost','cost','price','unit_measurement_id','deleted_by','created_at'])
            ->when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
                return $query->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))]);
            })
            //sub query used in search field
            ->when($request->input('column') && $request->input('value'), function ($query) use ($request){

                $query->when($request->input('column') == 'deletedBy' , function ($query) use ($request){
                    return $query->whereHas('deletedBy', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->input('value') . '%');
                    });
                })
                    ->when($request->input('column') == '_id', function ($query) use ($request){
                        return $query->where('id',  $request->input('value') );
                    })
                    ->when($request->input('column') == 'name', function ($query) use ($request){
                        return $query->where('name->en', 'like', '%' . $request->input('value') . '%')->orWhere('name->ar', 'like', '%' . $request->input('value') . '%');
                    })
                    ->when($request->input('column') == 'description', function ($query) use ($request){
                        return $query->where('description->en', 'like', '%' . $request->input('value') . '%')->orWhere('description->ar', 'like', '%' . $request->input('value') . '%');
                    })

                    ->when($request->input('column') == 'quantity', function ($query) use ($request){
                        return $query->where('quantity', 'like', '%' . $request->input('value') . '%');
                    })

                    ->when($request->input('column') == 'cost', function ($query) use ($request){
                        return $query->where('cost', 'like', '%' . $request->input('value') . '%');
                    })
                    ->when($request->input('column') == 'searchKey', function ($query) use ($request){

                        return $query->where('name->en', 'like', '%' . $request->input('value') . '%')->orWhere('name->ar', 'like', '%' . $request->input('value') . '%');
                    });

            });

    }
}
