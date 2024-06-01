<?php
namespace Organization\Actions\PointOfSale;
use Illuminate\Http\Request;

use Organization\Models\{LService, PointOfSale};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = PointOfSale::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
