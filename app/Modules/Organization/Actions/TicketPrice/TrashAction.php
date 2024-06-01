<?php
namespace Organization\Actions\TicketPrice;
use Illuminate\Http\Request;
use Organization\Models\{
    TicketSubCategory
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = TicketSubCategory::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
