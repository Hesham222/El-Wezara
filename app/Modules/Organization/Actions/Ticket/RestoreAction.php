<?php
namespace Organization\Actions\Ticket;
use Illuminate\Http\Request;
use Organization\Models\{
    Ticket
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Ticket::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
