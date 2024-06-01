<?php
namespace Organization\Actions\Department;;
use Illuminate\Http\Request;
use Organization\Models\{
    Department
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Department::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
