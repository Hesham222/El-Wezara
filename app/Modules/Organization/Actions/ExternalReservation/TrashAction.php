<?php
namespace Organization\Actions\ExternalReservation;
use Illuminate\Http\Request;
use Organization\Models\{
    ExternalReservation
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = ExternalReservation::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
