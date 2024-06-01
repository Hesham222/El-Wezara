<?php
namespace Organization\Actions\Account;;
use Illuminate\Http\Request;

use Organization\Models\{
    Account
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Account::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
