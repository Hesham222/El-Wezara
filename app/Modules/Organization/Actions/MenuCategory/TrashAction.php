<?php
namespace Organization\Actions\MenuCategory;
use Illuminate\Http\Request;
use Organization\Models\{MenuCategory};

class TrashAction
{
    public function execute(Request $request)
    {
        $record = MenuCategory::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
