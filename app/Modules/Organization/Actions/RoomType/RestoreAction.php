<?php
namespace Organization\Actions\RoomType;
use Illuminate\Http\Request;
use Organization\Models\{
    RoomType
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = RoomType::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
