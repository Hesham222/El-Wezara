<?php
namespace Organization\Actions\Role;;
use Illuminate\Http\Request;

use Organization\Models\{
    Role
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Role::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
