<?php
namespace Organization\Actions\employeeVacationType;;
use Illuminate\Http\Request;
use Organization\Models\{
    EmployeeVacationType
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = EmployeeVacationType::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
