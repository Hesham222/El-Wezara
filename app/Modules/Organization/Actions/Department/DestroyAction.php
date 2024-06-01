<?php
namespace Organization\Actions\Department;;
use Illuminate\Http\Request;

use Organization\Models\{
    Department
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Department::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
