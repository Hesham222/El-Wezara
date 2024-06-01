<?php
namespace Organization\Actions\Employee;;
use Illuminate\Http\Request;
use Organization\Models\{
    OrganizationAdmin ,Employee
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Employee::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
