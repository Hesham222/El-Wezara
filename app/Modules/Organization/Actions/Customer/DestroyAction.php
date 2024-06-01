<?php
namespace Organization\Actions\Customer;;
use Illuminate\Http\Request;

use Organization\Models\{
    Customer
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Customer::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
