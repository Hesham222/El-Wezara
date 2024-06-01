<?php
namespace Organization\Actions\EventItemType;
use Illuminate\Http\Request;
use Organization\Models\{
    EventItemType
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = EventItemType::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
