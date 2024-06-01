<?php
namespace Organization\Actions\LaundrySubCategory;
use Illuminate\Http\Request;

use Organization\Models\{LaundrySubCategory};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = LaundrySubCategory::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
