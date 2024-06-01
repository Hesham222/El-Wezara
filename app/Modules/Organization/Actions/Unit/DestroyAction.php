<?php
namespace Organization\Actions\Unit;;
use Illuminate\Http\Request;

use Organization\Models\{
    UnitMeasurement
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = UnitMeasurement::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
