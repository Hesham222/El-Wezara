<?php
namespace Organization\Actions\EmployeeType;;
use Illuminate\Http\Request;
use Organization\Models\{
    EmployeeType
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = EmployeeType::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
