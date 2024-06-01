<?php
namespace Organization\Actions\AssetCategory;;
use Illuminate\Http\Request;

use Organization\Models\{
    AssetCategory
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = AssetCategory::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
