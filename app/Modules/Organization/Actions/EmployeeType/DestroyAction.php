<?php
namespace Organization\Actions\EmployeeType;;
use Illuminate\Http\Request;

use Organization\Models\{
    EmployeeType
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = EmployeeType::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
