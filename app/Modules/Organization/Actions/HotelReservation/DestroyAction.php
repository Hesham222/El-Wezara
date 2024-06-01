<?php
namespace Organization\Actions\HotelReservation;;
use Illuminate\Http\Request;

use Organization\Models\{
    HotelReservation
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = HotelReservation::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
