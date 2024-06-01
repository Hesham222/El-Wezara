<?php
namespace Organization\Actions\ParentRoom;
use Illuminate\Http\Request;
use Organization\Models\{
    ParentRoom
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = ParentRoom::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
