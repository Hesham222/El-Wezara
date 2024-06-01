<?php
namespace Organization\Actions\MenuCategory;
use Illuminate\Http\Request;

use Organization\Models\{ MenuCategory};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = MenuCategory::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
