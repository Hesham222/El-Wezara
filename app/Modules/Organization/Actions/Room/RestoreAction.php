<?php
namespace Organization\Actions\Room;
use Illuminate\Http\Request;
use Organization\Models\{
    Rooms
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Rooms::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
