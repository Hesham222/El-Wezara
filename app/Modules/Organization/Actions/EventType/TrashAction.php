<?php
namespace Organization\Actions\EventType;
use Illuminate\Http\Request;
use Organization\Models\{EventType, SubscribersType};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = EventType::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
