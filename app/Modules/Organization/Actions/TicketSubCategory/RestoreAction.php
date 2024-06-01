<?php
namespace Organization\Actions\TicketSubCategory;;
use Illuminate\Http\Request;
use Organization\Models\{
    TicketSubCategory
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = TicketSubCategory::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
