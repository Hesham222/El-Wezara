<?php
namespace Organization\Actions\RentSpace;;
use Illuminate\Http\Request;

use Organization\Models\{
    RentSpace
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = RentSpace::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
