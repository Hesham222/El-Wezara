<?php
namespace Organization\Actions\EventItem;
use Illuminate\Http\Request;
use Organization\Models\{
    EventItem
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = EventItem::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
