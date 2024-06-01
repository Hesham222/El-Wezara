<?php
namespace Organization\Actions\Account;
use Illuminate\Http\Request;
use Organization\Models\{
    Account
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Account::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
