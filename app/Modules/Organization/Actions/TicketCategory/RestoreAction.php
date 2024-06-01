<?php
namespace Organization\Actions\TicketCategory;;
use Illuminate\Http\Request;
use Organization\Models\{
    TicketCategory
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = TicketCategory::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
