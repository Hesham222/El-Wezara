<?php
namespace Organization\Actions\LaundrySubCategory;
use Illuminate\Http\Request;
use Organization\Models\{LaundrySubCategory};

class TrashAction
{
    public function execute(Request $request)
    {
        $record = LaundrySubCategory::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
