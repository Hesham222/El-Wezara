<?php
namespace Organization\Actions\LaundryCategory;
use Illuminate\Http\Request;
use Organization\Models\{
    LaundryCategory
};

class TrashAction
{
    public function execute(Request $request)
    {
        $record = LaundryCategory::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
