<?php
namespace Organization\Actions\Reservation;
use Illuminate\Http\Request;
use Organization\Models\{EventType, Package, Reservation, SubscribersType};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Reservation::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
