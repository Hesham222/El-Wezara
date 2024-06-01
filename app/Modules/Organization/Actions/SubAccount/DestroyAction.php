<?php
namespace Organization\Actions\SubAccount;;
use Illuminate\Http\Request;

use Organization\Models\{
    SubAccount
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = SubAccount::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
