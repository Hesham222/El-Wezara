<?php
namespace Organization\Actions\CustomerType;;
use Illuminate\Http\Request;

use Organization\Models\{
    CustomerType
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = CustomerType::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
