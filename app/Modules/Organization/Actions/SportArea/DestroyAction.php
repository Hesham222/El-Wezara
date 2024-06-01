<?php
namespace Organization\Actions\SportArea;;
use Illuminate\Http\Request;

use Organization\Models\{
    SportActivityAreas
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = SportActivityAreas::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
