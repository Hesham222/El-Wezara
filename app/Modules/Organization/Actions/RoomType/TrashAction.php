<?php
namespace Organization\Actions\RoomType;
use Illuminate\Http\Request;
use Organization\Models\{
    RoomType
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = RoomType::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
