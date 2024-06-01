<?php
namespace Organization\Actions\ParentRoom;
use Illuminate\Http\Request;

use Organization\Models\{
    ParentRoom
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = ParentRoom::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
