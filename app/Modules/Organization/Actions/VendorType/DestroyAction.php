<?php
namespace Organization\Actions\VendorType;;
use Illuminate\Http\Request;

use Organization\Models\{CustomerType, VendorType};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = VendorType::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
