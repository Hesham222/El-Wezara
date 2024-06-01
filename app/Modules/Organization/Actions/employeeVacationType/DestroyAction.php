<?php
namespace Organization\Actions\employeeVacationType;;
use Illuminate\Http\Request;

use Organization\Models\{
    EmployeeVacationType
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = EmployeeVacationType::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
