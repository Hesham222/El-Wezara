<?php
namespace Organization\Actions\Vendor;;
use Illuminate\Http\Request;

use Organization\Models\{
    Vendor
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Vendor::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
