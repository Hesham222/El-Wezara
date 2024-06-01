<?php
namespace Organization\Actions\AssetCategory;
use Illuminate\Http\Request;
use Organization\Models\{
    AssetCategory
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = AssetCategory::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
