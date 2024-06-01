<?php
namespace Organization\Actions\IngredientCategory;
use Illuminate\Http\Request;
use Organization\Models\{
    IngredientCategory
};

class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                         = IngredientCategory::find($id);
        $record->name                   = $request->input('name');
        if($request->input('parent_id') == 0)
        {
            $record->parent_id = Null;
        }else{
            $record->parent_id              = $request->input('parent_id');
        }
        $record->description            = $request->input('description');
        $record->save();
        return $record;
    }
}
