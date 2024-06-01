<?php
namespace Organization\Actions\SubAccount;
use Illuminate\Http\Request;
use Organization\Models\{
    SubAccount
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = SubAccount::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
