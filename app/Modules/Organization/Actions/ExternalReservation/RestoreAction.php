<?php
namespace Organization\Actions\ExternalReservation;
use Illuminate\Http\Request;
use Organization\Models\{
    ExternalReservation
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = ExternalReservation::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
