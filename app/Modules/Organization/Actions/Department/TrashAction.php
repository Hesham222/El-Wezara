<?php
namespace Organization\Actions\Department;
use Illuminate\Http\Request;
use Organization\Models\{
    Department
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = Department::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
