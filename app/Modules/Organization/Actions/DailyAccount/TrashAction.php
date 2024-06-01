<?php
namespace Organization\Actions\DailyAccount;
use Illuminate\Http\Request;
use Organization\Models\{
    DailyAccount
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = DailyAccount::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
