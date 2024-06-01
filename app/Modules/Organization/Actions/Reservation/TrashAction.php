<?php
namespace Organization\Actions\Reservation;
use Illuminate\Http\Request;
use Organization\Models\{EventType, Package, Reservation, SubscribersType};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = Reservation::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
