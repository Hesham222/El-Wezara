<?php
namespace Organization\Actions\GateShift;;
use Illuminate\Http\Request;

use Organization\Models\{
    GateShift
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = GateShift::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
