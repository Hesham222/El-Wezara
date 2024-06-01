<?php
namespace Organization\Actions\AssetCategory;
use Illuminate\Http\Request;
use Organization\Models\{
    AssetCategory
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = AssetCategory::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
