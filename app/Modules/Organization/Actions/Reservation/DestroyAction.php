<?php
namespace Organization\Actions\Reservation;
use Illuminate\Http\Request;

use Organization\Models\{EventType, Package, Reservation, SubscribersType};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Reservation::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
