<?php
namespace Organization\Actions\Room;;
use Illuminate\Http\Request;

use Organization\Models\{
    Rooms
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Rooms::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
