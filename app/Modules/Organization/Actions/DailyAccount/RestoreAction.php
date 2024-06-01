<?php
namespace Organization\Actions\DailyAccount;
use Illuminate\Http\Request;
use Organization\Models\{
    DailyAccount
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = DailyAccount::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
