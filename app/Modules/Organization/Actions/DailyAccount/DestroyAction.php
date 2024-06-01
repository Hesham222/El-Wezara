<?php
namespace Organization\Actions\DailyAccount;
use Illuminate\Http\Request;

use Organization\Models\{
    DailyAccount
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = DailyAccount::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
