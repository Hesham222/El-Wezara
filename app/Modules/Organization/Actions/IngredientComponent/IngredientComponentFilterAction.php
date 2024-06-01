<?php
namespace Organization\Actions\IngredientComponent;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Organization\Models\Ingredient;

class IngredientComponentFilterAction
{
    public function execute(Request $request)
    {
        return Ingredient::when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
            return $query->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))]);
        })
        //sub query used in search field
        ->when($request->input('column') && $request->input('value'), function ($query) use ($request){
            return $query->when($request->input('column') == '_id', function ($query) use ($request){
                    return $query->where('id',  $request->input('value') );
                })
                ->when($request->input('column') == 'ingredient', function ($query) use ($request){
                     $query->whereHas('manufactured',function ($q) use($request){
                         $q->where('name->ar', 'like', '%' . $request->input('value') . '%');

                    })
                    ->when($request->input('column') == 'ingredient', function ($query) use ($request){
                        $query->where('name->ar', 'like', '%' . $request->input('value') . '%');

                        });
            });
        });
    }
}
