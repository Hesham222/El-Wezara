<?php
namespace Organization\Actions\Ingredient;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Organization\Models\VendorIngredient;

class IngredientFilterAction
{
    public function execute(Request $request)
    {
        return VendorIngredient::
            select(['id','price', 'vendor_id','ingredient_id','deleted_by','created_at'])
            ->with('Vendor','Ingredient')
        ->when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
            return $query->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))]);
        })
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
            });

            })->when($request->input('ingredient'), function ($query) use ($request){
                return $query->whereHas('Ingredient',function ($q) use ($request){
                    $q-> where('name->ar', 'like', '%' .  $request->input('ingredient'). '%' );
            });
            });

    }
}
