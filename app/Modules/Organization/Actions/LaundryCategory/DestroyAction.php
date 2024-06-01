<?php
namespace Organization\Actions\LaundryCategory;;
use Illuminate\Http\Request;

use Organization\Models\{
    LaundryCategory
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = LaundryCategory::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
