<?php
namespace Organization\Actions\Account;
use Illuminate\Http\Request;
use Organization\Models\{
    Account
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = Account::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
