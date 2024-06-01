<?php
namespace Organization\Actions\Ingredient;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Organization\Models\IngredentExecutionSheet;
use Organization\Models\Ingredient;

class FilterExecIngAction
{
    public function execute(Request $request)
    {

    
         return IngredentExecutionSheet::
       
         when($request->input('view') == 'trash', function ($query) use ($request) {
            return $query->onlyTrashed();
        })

            ->select(['id','created_by', 'ingredient_id','quantity','expiration_date','created_at'])
            ->when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
                return $query->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))]);
            })
            //sub query used in search field
            
                    ->when($request->input('column') == '_id', function ($query) use ($request){
                        return $query->where('id',  $request->input('value') );
                    })
                    ->when($request->input('column') == 'ingredient', function ($query) use ($request){
                        $query->whereHas('ingredient',function($q) use($request){
                            return $query->where('name->en', 'like', '%' . $request->input('value') . '%')->orWhere('name->ar', 'like', '%' . $request->input('value') . '%');
                        });
                       
                    });
                

    }
}
