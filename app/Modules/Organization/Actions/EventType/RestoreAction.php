<?php
namespace Organization\Actions\EventType;
use Illuminate\Http\Request;
use Organization\Models\{EventType, SubscribersType};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = EventType::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
