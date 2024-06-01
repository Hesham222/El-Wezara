<?php
namespace Organization\Actions\LaundrySubCategory;
use Illuminate\Http\Request;
use Organization\Models\{LaundrySubCategory};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = LaundrySubCategory::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
