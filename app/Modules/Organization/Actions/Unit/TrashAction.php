<?php
namespace Organization\Actions\Unit;
use Illuminate\Http\Request;
use Organization\Models\{
    UnitMeasurement
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = UnitMeasurement::find($request->resource_id);
        if(!$record)
            return false;
       /*
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    */
        $record->forceDelete();
        return $request->resource_id;
       }
}
