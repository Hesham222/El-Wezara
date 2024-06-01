<?php
namespace Organization\Actions\IngredientCategory;
use Illuminate\Http\Request;
use Organization\Models\{
    IngredientCategory
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = IngredientCategory::find($request->resource_id);
        if(!$record)
            return false;
       /*
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
       */

        $record->forceDelete();
        return $request->resource_id;
    }
}
