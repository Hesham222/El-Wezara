<?php
namespace Organization\Actions\EmployeeJob;;
use Illuminate\Http\Request;

use Organization\Models\{
    EmployeeJob
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = EmployeeJob::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
