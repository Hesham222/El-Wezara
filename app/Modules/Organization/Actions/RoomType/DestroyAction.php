<?php
namespace Organization\Actions\RoomType;;
use Illuminate\Http\Request;

use Organization\Models\{
    RoomType
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = RoomType::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
