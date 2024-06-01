<?php
namespace Organization\Actions\complain;
use Illuminate\Http\Request;
use Organization\Models\{CustomerComplain, CustomerType};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = CustomerComplain::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
