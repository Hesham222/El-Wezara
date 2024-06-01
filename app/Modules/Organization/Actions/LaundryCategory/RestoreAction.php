<?php
namespace Organization\Actions\LaundryCategory;
use Illuminate\Http\Request;
use Organization\Models\{
    LaundryCategory
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = LaundryCategory::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
