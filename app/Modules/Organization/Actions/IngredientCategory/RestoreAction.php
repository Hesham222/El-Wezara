<?php
namespace Organization\Actions\IngredientCategory;;
use Illuminate\Http\Request;
use Organization\Models\{
    IngredientCategory
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = IngredientCategory::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
