<?php
namespace Organization\Actions\EmployeeType;
use Illuminate\Http\Request;
use Organization\Models\{
    EmployeeType
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = EmployeeType::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
