<?php
namespace Organization\Actions\MenuCategory;
use Illuminate\Http\Request;
use Organization\Models\{LaundryCategory, MenuCategory};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = MenuCategory::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
