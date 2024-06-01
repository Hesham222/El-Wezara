<?php
namespace Organization\Actions\EmployeeJob;;
use Illuminate\Http\Request;
use Organization\Models\{
    EmployeeJob
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = EmployeeJob::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
