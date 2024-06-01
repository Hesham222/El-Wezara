<?php
namespace Organization\Actions\IngredientCategory;;
use Illuminate\Http\Request;

use Organization\Models\{
    IngredientCategory
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = IngredientCategory::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
