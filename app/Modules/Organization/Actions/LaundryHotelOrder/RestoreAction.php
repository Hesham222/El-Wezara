<?php
namespace Organization\Actions\LaundryHotelOrder;
use Illuminate\Http\Request;
use Organization\Models\{laundry, LaundryOrder};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = LaundryOrder::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
