<?php
namespace Organization\Actions\Supplier;
use Illuminate\Http\Request;

use Organization\Models\{SportActivityAreas, Supplier};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Supplier::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
