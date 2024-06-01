<?php
namespace Organization\Actions\GateShift;
use Illuminate\Http\Request;
use Organization\Models\{
    GateShift
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = GateShift::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
