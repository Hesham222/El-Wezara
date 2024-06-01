<?php
namespace Organization\Actions\EventItemType;;
use Illuminate\Http\Request;
use Organization\Models\{
    EventItemType
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = EventItemType::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
