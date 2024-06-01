<?php
namespace Organization\Actions\Laundry;;
use Illuminate\Http\Request;

use Organization\Models\{
    laundry
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = laundry::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
