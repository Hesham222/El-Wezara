<?php
namespace Organization\Actions\complain;;
use Illuminate\Http\Request;

use Organization\Models\{CustomerComplain, CustomerType};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = CustomerComplain::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
