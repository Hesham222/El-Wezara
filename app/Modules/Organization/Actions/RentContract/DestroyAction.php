<?php
namespace Organization\Actions\RentContract;
use Illuminate\Http\Request;

use Organization\Models\{
    RentContract
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = RentContract::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
