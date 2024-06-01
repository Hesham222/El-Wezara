<?php
namespace Admin\Actions\Organization;;
use Illuminate\Http\Request;

use Admin\Models\{
    Organization
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Organization::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
