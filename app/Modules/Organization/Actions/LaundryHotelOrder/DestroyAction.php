<?php
namespace Organization\Actions\LaundryHotelOrder;
use Illuminate\Http\Request;

use Organization\Models\{laundry, LaundryOrder};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = LaundryOrder::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
