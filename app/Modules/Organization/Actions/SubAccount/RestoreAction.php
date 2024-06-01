<?php
namespace Organization\Actions\SubAccount;
use Illuminate\Http\Request;
use Organization\Models\{
    SubAccount
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = SubAccount::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
