<?php
namespace Organization\Actions\Tenant;;
use Illuminate\Http\Request;

use Organization\Models\{
    Tenant
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Tenant::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
