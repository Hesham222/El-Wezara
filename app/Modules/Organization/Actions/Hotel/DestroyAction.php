<?php
namespace Organization\Actions\Hotel;;
use Illuminate\Http\Request;

use Organization\Models\{
    Hotel
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Hotel::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
