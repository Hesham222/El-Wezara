<?php
namespace Organization\Actions\PointOfSaleOrder;
use Illuminate\Http\Request;
use Organization\Models\{laundry, LaundryOrder};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = LaundryOrder::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
