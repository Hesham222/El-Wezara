<?php
namespace Organization\Actions\EventItem;;
use Illuminate\Http\Request;
use Organization\Models\{
    EventItem
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = EventItem::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
