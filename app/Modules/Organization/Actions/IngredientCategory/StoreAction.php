<?php
namespace Organization\Actions\IngredientCategory;
use Illuminate\Http\Request;
use Organization\Models\{
    IngredientCategory
};

class StoreAction
{
    public function execute(Request $request)
    {
        if($request->input('parent_id') == 0)
        {
            $record =  IngredientCategory::create([
                'name'                  =>  $request->input('name'),
                'parent_id'             => Null,
                'description'           =>  $request->input('description'),
            ]);
        }else{
            $record =  IngredientCategory::create([
                'name'                  =>  $request->input('name'),
                'parent_id'             =>  $request->input('parent_id'),
                'description'           =>  $request->input('description'),
            ]);
        }

        return $record;
    }
}
